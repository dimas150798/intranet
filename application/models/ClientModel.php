<?php


class ClientModel extends CI_Model
{
    public function index()
    {
        $response = [];

        $api = connect();
        $pppSecret = $api->comm('/ppp/secret/print');
        $api->disconnect();

        $getData = $this->db->query("
            SELECT 
            client.*,
            area.name as area_name, 
            paket.name as paket_name, 
            paket.price as paket_price, 
            sales.name as sales_name
            FROM client
            left join area on area.id = client.id_area
            left join paket on paket.id = client.id_paket
            left join sales on sales.id = client.id_sales
            order by client.id desc
            ")->result_array();

        foreach ($pppSecret as $keySecret => $valueSecret) {
            $status = false;

            foreach ($getData as $key => $value) {
                if ($valueSecret['name'] == $value['name_pppoe']) {
                    $status = true;

                    $this->db->update("client", ['id_pppoe'=>$valueSecret['.id'] ], ['id' => $value['id']]);

                    $response[$keySecret] = [
                        'id' => $value['id'],
                        'code_client' => $value['code_client'],
                        'phone' => $value['phone'],
                        'latitude' => $value['latitude'],
                        'longitude' => $value['longitude'],
                        'id_pppoe' => $valueSecret['.id'],
                        'name' => $valueSecret['name'],
                        'email' => $value['email'],
                        'id_paket' => $value['id_paket'],
                        'name_pppoe' => $valueSecret['name'],
                        'password_pppoe' => $valueSecret['password'],
                        'disabled' => $valueSecret['disabled'],
                        'address' => $value['address'],
                        'description' => $value['description'],
                        'start_date' => $value['start_date'],
                        'stop_date' => $value['stop_date'],
                        'area_name' => $value['area_name'],
                        'paket_name' => $value['paket_name'],
                        'paket_price' => $value['paket_price'],
                        'sales_name' => $value['sales_name'],
                        'created_at' => $value['created_at'],
                        'updated_at' => $value['updated_at'],
                    ];
                }
            }
            if ($status == false) {
                $this->db->insert("client", [
                    "name" => $valueSecret['name'],
                    "id_paket" => 0,
                    "code_client" => '0',
                    "phone" => '0',
                    "latitude" => '0',
                    "longitude" => '0',
                    "start_date" => date('Y-m-d H:i:s', time()),
                    'name_pppoe' => $valueSecret['name'],
                    'password_pppoe' => $valueSecret['password'],
                    'id_pppoe' => $valueSecret['.id'],
                    'address' => '-',
                    "id_area" => 0,
                    "description" => '-',
                    "id_sales" => 0
                ]);

                $lastPay = date("Y-m-d", strtotime("+1 months"));
                $payStatus = [];

                $response[$keySecret] = [
                    'id' => $this->db->insert_id(),
                    'id_pppoe' => $valueSecret['.id'],
                    'name' => $valueSecret['name'],
                    'email' => '',
                    'code_client' => '',
                    'phone' => '',
                    'latitude' => '',
                    'longitude' => '',
                    'id_paket' => 0,
                    'name_pppoe' => $valueSecret['name'],
                    'password_pppoe' => $valueSecret['password'],
                    'disabled' => $valueSecret['disabled'],
                    'address' => '-',
                    'description' => '-',
                    'start_date' => date('Y-m-d H:i:s', time()),
                    'stop_date' => null,
                    'expired_date' => null,
                    'area_name' => '',
                    'paket_name' => '',
                    'paket_price' => '',
                    'sales_name' => '',
                    'created_at' => date('Y-m-d H:i:s', time()),
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ];
            }
        }

        return $response;
    }

    // Menampilkan data customer dari awal tanggal sampai akhir tanggal
    public function getDataClient($tanggalAwal, $tanggalAkhir)
    {
        $query   = $this->db->query("SELECT client.id, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
        data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
        data_pembayaran.status_code, data_pembayaran.gross_amount,
        data_pembayaran.nama, data_pembayaran.paket,
        data_pembayaran.nama_admin, data_pembayaran.keterangan,
        data_pembayaran.payment_type, 
        MONTH(data_pembayaran.transaction_time) AS bulan,
        data_pembayaran.transaction_time, data_pembayaran.bank,
        data_pembayaran.va_number, data_pembayaran.permata_va_number,
        data_pembayaran.payment_code, data_pembayaran.bill_key,
        data_pembayaran.biller_code, data_pembayaran.pdf_url,
        paket.name AS namaPaket, paket.price AS hargaPaket
        
        FROM client 
        LEFT OUTER JOIN paket ON client.id_paket = paket.id
        LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
        
        AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir'
        
        WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
        AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL

        GROUP BY client.name_pppoe
        ORDER BY data_pembayaran.order_id DESC");

        return $query->result_array();
    }

    // Menghitung Jumlah Customer Yang Belum Bayar Dari Awal Tanggal sampai Akhir tanggal
    public function hitungPembayaranBelum($tanggalAwal, $tanggalAkhir)
    {
        $query   = $this->db->query("SELECT client.id, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
        data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
        data_pembayaran.status_code, data_pembayaran.gross_amount,
        data_pembayaran.nama, data_pembayaran.paket,
        data_pembayaran.nama_admin, data_pembayaran.keterangan,
        data_pembayaran.payment_type, 
        MONTH(data_pembayaran.transaction_time) AS bulan,
        data_pembayaran.transaction_time, data_pembayaran.bank,
        data_pembayaran.va_number, data_pembayaran.permata_va_number,
        data_pembayaran.payment_code, data_pembayaran.bill_key,
        data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
        paket.name AS namaPaket, paket.price AS hargaPaket
        
        FROM client 
        LEFT OUTER JOIN paket ON client.id_paket = paket.id
        LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
        
        AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
        
        WHERE client.start_date BETWEEN '2022-07-01'  AND '$tanggalAkhir' 
        AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL

        GROUP BY client.name_pppoe
        ORDER BY data_pembayaran.transaction_time DESC, client.name ASC");

        return $query->num_rows();
    }

    public function hitungPembayaranBelumPertanggal($tanggalAwal, $tanggalAkhir, $day)
    {
        $pecahDay      = explode("-", $tanggalAkhir);

        $tahun         = $pecahDay[0];
        $bulan         = $pecahDay[1];
        $dayTanggal    = $pecahDay[2];

        if ($bulan == 2) {
            if ($day == 28) {
                $query   = $this->db->query("SELECT client.id, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
                data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
                data_pembayaran.status_code, data_pembayaran.gross_amount,
                data_pembayaran.nama, data_pembayaran.paket,
                data_pembayaran.nama_admin, data_pembayaran.keterangan,
                data_pembayaran.payment_type, 
                MONTH(data_pembayaran.transaction_time) AS bulan,
                data_pembayaran.transaction_time, data_pembayaran.bank,
                data_pembayaran.va_number, data_pembayaran.permata_va_number,
                data_pembayaran.payment_code, data_pembayaran.bill_key,
                data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
                paket.name AS namaPaket, paket.price AS hargaPaket
                
                FROM client 
                LEFT OUTER JOIN paket ON client.id_paket = paket.id
                LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
                
                AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
                
                WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
                AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL
                AND DAY(client.start_date) >= '$day'
        
                GROUP BY client.name_pppoe
                ORDER BY data_pembayaran.transaction_time DESC, client.name ASC");

                return $query->num_rows();
            } else {
                $query   = $this->db->query("SELECT client.id, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
                data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
                data_pembayaran.status_code, data_pembayaran.gross_amount,
                data_pembayaran.nama, data_pembayaran.paket,
                data_pembayaran.nama_admin, data_pembayaran.keterangan,
                data_pembayaran.payment_type, 
                MONTH(data_pembayaran.transaction_time) AS bulan,
                data_pembayaran.transaction_time, data_pembayaran.bank,
                data_pembayaran.va_number, data_pembayaran.permata_va_number,
                data_pembayaran.payment_code, data_pembayaran.bill_key,
                data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
                paket.name AS namaPaket, paket.price AS hargaPaket
                
                FROM client 
                LEFT OUTER JOIN paket ON client.id_paket = paket.id
                LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
                
                AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
                
                WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
                AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL
                AND DAY(client.start_date) = '$day'
        
                GROUP BY client.name_pppoe
                ORDER BY data_pembayaran.transaction_time DESC, client.name ASC");

                return $query->num_rows();
            }
        } else {
            $query   = $this->db->query("SELECT client.id, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
            data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
            data_pembayaran.status_code, data_pembayaran.gross_amount,
            data_pembayaran.nama, data_pembayaran.paket,
            data_pembayaran.nama_admin, data_pembayaran.keterangan,
            data_pembayaran.payment_type, 
            MONTH(data_pembayaran.transaction_time) AS bulan,
            data_pembayaran.transaction_time, data_pembayaran.bank,
            data_pembayaran.va_number, data_pembayaran.permata_va_number,
            data_pembayaran.payment_code, data_pembayaran.bill_key,
            data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
            paket.name AS namaPaket, paket.price AS hargaPaket
            
            FROM client 
            LEFT OUTER JOIN paket ON client.id_paket = paket.id
            LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
            
            AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
            
            WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
            AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL
            AND DAY(client.start_date) = '$day'
    
            GROUP BY client.name_pppoe
            ORDER BY data_pembayaran.transaction_time DESC, client.name ASC");

            return $query->num_rows();
        }
    }

    public function hitungPembayaranSudah($tanggalAwal, $tanggalAkhir)
    {
        $query   = $this->db->query("SELECT client.id, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
        data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
        data_pembayaran.status_code, data_pembayaran.gross_amount,
        data_pembayaran.nama, data_pembayaran.paket,
        data_pembayaran.nama_admin, data_pembayaran.keterangan,
        data_pembayaran.payment_type, 
        MONTH(data_pembayaran.transaction_time) AS bulan,
        data_pembayaran.transaction_time, data_pembayaran.bank,
        data_pembayaran.va_number, data_pembayaran.permata_va_number,
        data_pembayaran.payment_code, data_pembayaran.bill_key,
        data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
        paket.name AS namaPaket, paket.price AS hargaPaket
        
        FROM client 
        LEFT OUTER JOIN paket ON client.id_paket = paket.id
        LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
        
        WHERE data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
        AND client.stop_date IS NULL

        GROUP BY client.name_pppoe
        ORDER BY data_pembayaran.order_id DESC");

        return $query->num_rows();
    }

    public function invoice()
    {
        $sql = "SELECT MAX(MID(order_id,8,4)) AS invoiceID 
        FROM data_pembayaran_history
        WHERE MID(order_id,4,4) = DATE_FORMAT(CURDATE(), '%y%m')";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $dataRow    = $query->row();
            $dataN      = ((int)$dataRow->invoiceID) + 1;
            $no         = sprintf("%'.04d", $dataN);
        } else {
            $no         = "0001";
        }

        $invoice = "IN7".date('ym').$no;
        return $invoice;
    }

    public function cekPembayaran($bulanPayment, $tahunPayment, $nama)
    {
        $this->db->select('order_id, gross_amount, nama, paket, nama_admin, keterangan, 
        payment_type, transaction_time, MONTH(transaction_time) AS bulanPayment, YEAR(transaction_time) AS tahunPayment, expired_date, bank, va_number, permata_va_number, 
        payment_code, bill_key, biller_code, pdf_url, status_code');
        $this->db->where('MONTH(transaction_time)', $bulanPayment);
        $this->db->where('YEAR(transaction_time)', $tahunPayment);
        $this->db->where('nama', $nama);
        $this->db->order_by('transaction_time', 'DESC');

        $this->db->limit(1);
        $result = $this->db->get('data_pembayaran');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    public function insertData($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function updateData($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }

    public function deleteData($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function dataPaket()
    {
        $this->db->select('id, name, price, description, created_at, updated_at');
        $this->db->from('paket');

        return $this->db->get()->result();
    }

    public function dataArea()
    {
        $this->db->select('id, name, created_at, updated_at');
        $this->db->from('area');
        $this->db->order_by('name');

        return $this->db->get()->result();
    }

    public function dataAreaPelanggan()
    {
        $this->db->select('area.id, area.name AS namaArea, area.created_at, area.updated_at, COUNT(client.id_area) AS jumlahArea');
        $this->db->from('client');
        $this->db->join('area', 'client.id_area = area.id', 'left');
        $this->db->group_by('client.id_area');
        $this->db->order_by('area.name');
        return $this->db->get()->result_array();
    }

    public function dataSales()
    {
        $this->db->select('id, name, phone, created_at, updated_at');
        $this->db->from('sales');

        return $this->db->get()->result();
    }

    public function getDataTerminasi($tanggalAwal, $tanggalAkhir, $day)
    {
        $pecahDay      = explode("-", $tanggalAkhir);

        $tahun         = $pecahDay[0];
        $bulan         = $pecahDay[1];
        $dayTanggal    = $pecahDay[2];

        if ($bulan == 2) {
            if ($day == 28) {
                $query   = $this->db->query("SELECT client.id, client.start_date, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
                data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
                data_pembayaran.status_code, data_pembayaran.gross_amount,
                data_pembayaran.nama, data_pembayaran.paket,
                data_pembayaran.nama_admin, data_pembayaran.keterangan,
                data_pembayaran.payment_type, 
                MONTH(data_pembayaran.transaction_time) AS bulan,
                data_pembayaran.transaction_time, data_pembayaran.bank,
                data_pembayaran.va_number, data_pembayaran.permata_va_number,
                data_pembayaran.payment_code, data_pembayaran.bill_key,
                data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
                paket.name AS namaPaket, paket.price AS hargaPaket
                
                FROM client 
                LEFT OUTER JOIN paket ON client.id_paket = paket.id
                LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
                
                AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
                
                WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
                AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL
                AND DAY(client.start_date) >= '$day'
        
                GROUP BY client.name_pppoe
                ORDER BY client.name_pppoe ASC");

                return $query->result_array();
            } else {
                $query   = $this->db->query("SELECT client.id, client.start_date, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
                data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
                data_pembayaran.status_code, data_pembayaran.gross_amount,
                data_pembayaran.nama, data_pembayaran.paket,
                data_pembayaran.nama_admin, data_pembayaran.keterangan,
                data_pembayaran.payment_type, 
                MONTH(data_pembayaran.transaction_time) AS bulan,
                data_pembayaran.transaction_time, data_pembayaran.bank,
                data_pembayaran.va_number, data_pembayaran.permata_va_number,
                data_pembayaran.payment_code, data_pembayaran.bill_key,
                data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
                paket.name AS namaPaket, paket.price AS hargaPaket
                
                FROM client 
                LEFT OUTER JOIN paket ON client.id_paket = paket.id
                LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
                
                AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
                
                WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
                AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL
                AND DAY(client.start_date) = '$day'
        
                GROUP BY client.name_pppoe
                ORDER BY client.name_pppoe ASC");

                return $query->result_array();
            }
        } else {
            $query   = $this->db->query("SELECT client.id, client.start_date, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
            data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
            data_pembayaran.status_code, data_pembayaran.gross_amount,
            data_pembayaran.nama, data_pembayaran.paket,
            data_pembayaran.nama_admin, data_pembayaran.keterangan,
            data_pembayaran.payment_type, 
            MONTH(data_pembayaran.transaction_time) AS bulan,
            data_pembayaran.transaction_time, data_pembayaran.bank,
            data_pembayaran.va_number, data_pembayaran.permata_va_number,
            data_pembayaran.payment_code, data_pembayaran.bill_key,
            data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
            paket.name AS namaPaket, paket.price AS hargaPaket
            
            FROM client 
            LEFT OUTER JOIN paket ON client.id_paket = paket.id
            LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
            
            AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
            
            WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
            AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL
            AND DAY(client.start_date) = '$day'
    
            GROUP BY client.name_pppoe
            ORDER BY client.name_pppoe ASC");

            return $query->result_array();
        }
    }

    public function autoTerminasi($tanggalAwal, $tanggalAkhir, $day)
    {
        $pecahDay      = explode("-", $tanggalAkhir);

        $tahun         = $pecahDay[0];
        $bulan         = $pecahDay[1];
        $dayTanggal    = $pecahDay[2];

        if ($bulan == 2) {
            if ($day == 28) {
                $getData = $this->db->query("
                SELECT client.id, client.start_date, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
                data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
                data_pembayaran.status_code, data_pembayaran.gross_amount,
                data_pembayaran.nama, data_pembayaran.paket,
                data_pembayaran.nama_admin, data_pembayaran.keterangan,
                data_pembayaran.payment_type, 
                MONTH(data_pembayaran.transaction_time) AS bulan,
                data_pembayaran.transaction_time, data_pembayaran.bank,
                data_pembayaran.va_number, data_pembayaran.permata_va_number,
                data_pembayaran.payment_code, data_pembayaran.bill_key,
                data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
                paket.name AS namaPaket, paket.price AS hargaPaket
                
                FROM client 
                LEFT OUTER JOIN paket ON client.id_paket = paket.id
                LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
                
                AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
                
                WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
                AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL
                AND DAY(client.start_date) >= '$day'
        
                GROUP BY client.name_pppoe
                ORDER BY client.name_pppoe ASC
                ")->result_array();

                foreach ($getData as $value) {
                    date_default_timezone_set("Asia/Jakarta"); # add your city to set local time zone
                    $timeNow = date('H:i:s');
                    $timeOut = date('19:00:00');

                    if ($value['transaction_time'] == null && $value['status_code'] == null) {
                        if ($timeNow >= $timeOut) {
                            $api = connect();
                            $api->comm('/ppp/secret/set', [
                                ".id" => $value['id_pppoe'],
                                "disabled" => 'true',
                            ]);
                            $api->disconnect();
                        }
                    } else {
                        if ($value['transaction_time'] != null && $value['status_code'] == 200) {
                            $api = connect();
                            $api->comm('/ppp/secret/set', [
                                ".id" => $value['id_pppoe'],
                                "disabled" => 'false',
                            ]);
                            $api->disconnect();
                        }
                    }
                }
            } else {
                $getData = $this->db->query("
                SELECT client.id, client.start_date, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
                data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
                data_pembayaran.status_code, data_pembayaran.gross_amount,
                data_pembayaran.nama, data_pembayaran.paket,
                data_pembayaran.nama_admin, data_pembayaran.keterangan,
                data_pembayaran.payment_type, 
                MONTH(data_pembayaran.transaction_time) AS bulan,
                data_pembayaran.transaction_time, data_pembayaran.bank,
                data_pembayaran.va_number, data_pembayaran.permata_va_number,
                data_pembayaran.payment_code, data_pembayaran.bill_key,
                data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
                paket.name AS namaPaket, paket.price AS hargaPaket
                
                FROM client 
                LEFT OUTER JOIN paket ON client.id_paket = paket.id
                LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
                
                AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
                
                WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
                AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL
                AND DAY(client.start_date) = '$day'
        
                GROUP BY client.name_pppoe
                ORDER BY client.name_pppoe ASC
                ")->result_array();

                foreach ($getData as $value) {
                    date_default_timezone_set("Asia/Jakarta"); # add your city to set local time zone
                    $timeNow = date('H:i:s');
                    $timeOut = date('19:00:00');

                    if ($value['transaction_time'] == null && $value['status_code'] == null) {
                        if ($timeNow >= $timeOut) {
                            $api = connect();
                            $api->comm('/ppp/secret/set', [
                                ".id" => $value['id_pppoe'],
                                "disabled" => 'true',
                            ]);
                            $api->disconnect();
                        }
                    } else {
                        if ($value['transaction_time'] != null && $value['status_code'] == 200) {
                            $api = connect();
                            $api->comm('/ppp/secret/set', [
                                ".id" => $value['id_pppoe'],
                                "disabled" => 'false',
                            ]);
                            $api->disconnect();
                        }
                    }
                }
            }
        } else {
            $getData = $this->db->query("
            SELECT client.id, client.start_date, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
            data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
            data_pembayaran.status_code, data_pembayaran.gross_amount,
            data_pembayaran.nama, data_pembayaran.paket,
            data_pembayaran.nama_admin, data_pembayaran.keterangan,
            data_pembayaran.payment_type, 
            MONTH(data_pembayaran.transaction_time) AS bulan,
            data_pembayaran.transaction_time, data_pembayaran.bank,
            data_pembayaran.va_number, data_pembayaran.permata_va_number,
            data_pembayaran.payment_code, data_pembayaran.bill_key,
            data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
            paket.name AS namaPaket, paket.price AS hargaPaket
            
            FROM client 
            LEFT OUTER JOIN paket ON client.id_paket = paket.id
            LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
            
            AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
            
            WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
            AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL
            AND DAY(client.start_date) = '$day'
    
            GROUP BY client.name_pppoe
            ORDER BY client.name_pppoe ASC
            ")->result_array();

            foreach ($getData as $value) {
                date_default_timezone_set("Asia/Jakarta"); # add your city to set local time zone
                $timeNow = date('H:i:s');
                $timeOut = date('19:00:00');

                if ($value['transaction_time'] == null && $value['status_code'] == null) {
                    if ($timeNow >= $timeOut) {
                        $api = connect();
                        $api->comm('/ppp/secret/set', [
                            ".id" => $value['id_pppoe'],
                            "disabled" => 'true',
                        ]);
                        $api->disconnect();
                    }
                } else {
                    if ($value['transaction_time'] != null && $value['status_code'] == 200) {
                        $api = connect();
                        $api->comm('/ppp/secret/set', [
                            ".id" => $value['id_pppoe'],
                            "disabled" => 'false',
                        ]);
                        $api->disconnect();
                    }
                }
            }
        }
    }

    public function registrasiNew($bulan, $tahun)
    {
        $query   = $this->db->query("SELECT client.id, client.name, client.name_pppoe, DAY(client.start_date) AS hari
        
        FROM client 
        
        WHERE YEAR(client.start_date) = '$tahun' AND MONTH(client.start_date) = '$bulan'");

        return $query->num_rows();
    }

    public function customerKBS()
    {
        $query   = $this->db->query("SELECT client.id, client.name, client.stop_date
        
        FROM client
        WHERE client.stop_date IS NULL");
        return $query->num_rows();
    }

    public function totalCustomerJatuhTempo($bulan, $tahun, $day)
    {
        $query   = $this->db->query("SELECT client.id, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
        data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
        data_pembayaran.status_code, data_pembayaran.gross_amount,
        data_pembayaran.nama, data_pembayaran.paket,
        data_pembayaran.nama_admin, data_pembayaran.keterangan,
        data_pembayaran.payment_type, 
        MONTH(data_pembayaran.transaction_time) AS bulan,
        data_pembayaran.transaction_time, data_pembayaran.bank,
        data_pembayaran.va_number, data_pembayaran.permata_va_number,
        data_pembayaran.payment_code, data_pembayaran.bill_key,
        data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
        paket.name AS namaPaket, paket.price AS hargaPaket
        
        FROM client 
        LEFT OUTER JOIN paket ON client.id_paket = paket.id
        LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
        
        AND DAY(client.start_date) = '$day' AND MONTH(data_pembayaran.transaction_time) = '$bulan' AND YEAR(data_pembayaran.transaction_time) = '$tahun'
        
        WHERE DAY(client.start_date) = '$day'

        GROUP BY client.name_pppoe
        ORDER BY data_pembayaran.transaction_time DESC, client.name ASC");

        return $query->num_rows();
    }

    public function dataPembayaranBelum($tanggalAwal, $tanggalAkhir)
    {
        $query   = $this->db->query("SELECT client.id, client.start_date, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
        data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
        data_pembayaran.status_code, data_pembayaran.gross_amount,
        data_pembayaran.nama, data_pembayaran.paket,
        data_pembayaran.nama_admin, data_pembayaran.keterangan,
        data_pembayaran.payment_type, 
        MONTH(data_pembayaran.transaction_time) AS bulan,
        data_pembayaran.transaction_time, data_pembayaran.bank,
        data_pembayaran.va_number, data_pembayaran.permata_va_number,
        data_pembayaran.payment_code, data_pembayaran.bill_key,
        data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
        paket.name AS namaPaket, paket.price AS hargaPaket
        
        FROM client 
        LEFT OUTER JOIN paket ON client.id_paket = paket.id
        LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
        
        AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
        
        WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
        AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL

        GROUP BY client.name_pppoe
        ORDER BY DAY(client.start_date) ASC");

        return $query->result_array();
    }

    public function dataPembayaranBelumPertanggal($tanggalAwal, $tanggalAkhir, $day)
    {
        $pecahDay      = explode("-", $tanggalAkhir);

        $tahun         = $pecahDay[0];
        $bulan         = $pecahDay[1];
        $dayTanggal    = $pecahDay[2];

        if ($bulan == 2) {
            if ($day == 28) {
                $query   = $this->db->query("SELECT client.id, client.start_date, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
                data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
                data_pembayaran.status_code, data_pembayaran.gross_amount,
                data_pembayaran.nama, data_pembayaran.paket,
                data_pembayaran.nama_admin, data_pembayaran.keterangan,
                data_pembayaran.payment_type, 
                MONTH(data_pembayaran.transaction_time) AS bulan,
                data_pembayaran.transaction_time, data_pembayaran.bank,
                data_pembayaran.va_number, data_pembayaran.permata_va_number,
                data_pembayaran.payment_code, data_pembayaran.bill_key,
                data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
                paket.name AS namaPaket, paket.price AS hargaPaket
                
                FROM client 
                LEFT OUTER JOIN paket ON client.id_paket = paket.id
                LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
                
                AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
                
                WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
                AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL
                AND DAY(client.start_date) >= '$day'
        
                GROUP BY client.name_pppoe
                ORDER BY client.name_pppoe ASC");

                return $query->result_array();
            } else {
                $query   = $this->db->query("SELECT client.id, client.start_date, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
                data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
                data_pembayaran.status_code, data_pembayaran.gross_amount,
                data_pembayaran.nama, data_pembayaran.paket,
                data_pembayaran.nama_admin, data_pembayaran.keterangan,
                data_pembayaran.payment_type, 
                MONTH(data_pembayaran.transaction_time) AS bulan,
                data_pembayaran.transaction_time, data_pembayaran.bank,
                data_pembayaran.va_number, data_pembayaran.permata_va_number,
                data_pembayaran.payment_code, data_pembayaran.bill_key,
                data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
                paket.name AS namaPaket, paket.price AS hargaPaket
                
                FROM client 
                LEFT OUTER JOIN paket ON client.id_paket = paket.id
                LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
                
                AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
                
                WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
                AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL
                AND DAY(client.start_date) = '$day'
        
                GROUP BY client.name_pppoe
                ORDER BY client.name_pppoe ASC");

                return $query->result_array();
            }
        } else {
            $query   = $this->db->query("SELECT client.id, client.start_date, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
            data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
            data_pembayaran.status_code, data_pembayaran.gross_amount,
            data_pembayaran.nama, data_pembayaran.paket,
            data_pembayaran.nama_admin, data_pembayaran.keterangan,
            data_pembayaran.payment_type, 
            MONTH(data_pembayaran.transaction_time) AS bulan,
            data_pembayaran.transaction_time, data_pembayaran.bank,
            data_pembayaran.va_number, data_pembayaran.permata_va_number,
            data_pembayaran.payment_code, data_pembayaran.bill_key,
            data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
            paket.name AS namaPaket, paket.price AS hargaPaket
            
            FROM client 
            LEFT OUTER JOIN paket ON client.id_paket = paket.id
            LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
            
            AND data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
            
            WHERE client.start_date BETWEEN '2022-07-01' AND '$tanggalAkhir'
            AND data_pembayaran.transaction_time IS NULL AND  client.stop_date IS NULL
            AND DAY(client.start_date) = '$day'
    
            GROUP BY client.name_pppoe
            ORDER BY client.name_pppoe ASC");

            return $query->result_array();
        }
    }

    public function dataPembayaranSudah($tanggalAwal, $tanggalAkhir)
    {
        $query   = $this->db->query("SELECT client.id, client.start_date, client.id_pppoe, client.name, client.name_pppoe, DAY(client.start_date) AS hari,
        data_pembayaran.transaction_time AS transaction_time, data_pembayaran.order_id,
        data_pembayaran.status_code, data_pembayaran.gross_amount,
        data_pembayaran.nama, data_pembayaran.paket,
        data_pembayaran.nama_admin, data_pembayaran.keterangan,
        data_pembayaran.payment_type, 
        MONTH(data_pembayaran.transaction_time) AS bulan,
        data_pembayaran.transaction_time, data_pembayaran.bank,
        data_pembayaran.va_number, data_pembayaran.permata_va_number,
        data_pembayaran.payment_code, data_pembayaran.bill_key,
        data_pembayaran.biller_code, data_pembayaran.pdf_url, data_pembayaran.status_code,
        paket.name AS namaPaket, paket.price AS hargaPaket
        
        FROM client 
        LEFT OUTER JOIN paket ON client.id_paket = paket.id
        LEFT OUTER JOIN data_pembayaran ON client.name_pppoe = data_pembayaran.nama
        
        WHERE data_pembayaran.transaction_time BETWEEN '$tanggalAwal' AND '$tanggalAkhir' + INTERVAL 23 HOUR
        AND client.stop_date IS NULL

        GROUP BY client.name_pppoe
        ORDER BY data_pembayaran.order_id DESC");

        return $query->result_array();
    }

    public function getDataClientTerminated($bulan, $tahun)
    {
        $query   = $this->db->query("SELECT 
        client.id, client.code_client, client.phone,
        client.name, client.name_pppoe, client.start_date,
        client.address, client.stop_date,

        paket.name AS namaPaket, paket.price AS hargaPaket
        
        FROM client 
        LEFT OUTER JOIN paket ON client.id_paket = paket.id
        
        WHERE YEAR(client.stop_date) = '$tahun' AND MONTH(client.stop_date) = '$bulan'

        GROUP BY client.name_pppoe
        ORDER BY client.stop_date DESC");

        return $query->result_array();
    }

    public function dataPelanggan()
    {
        $query   = $this->db->query("SELECT 
            client.id, client.code_client, client.phone, client.latitude, client.longitude,
            client.name, client.id_paket, client.name_pppoe, client.password_pppoe, client.id_pppoe, 
            client.address, client.email, client.start_date, client.stop_date, client.id_area, client.description,
            client.id_sales, paket.name AS namaPaket, sales.name AS namaSales, area.name AS namaArea

            FROM client

            LEFT JOIN paket ON client.id_paket = paket.id
            LEFT JOIN sales ON client.id_sales = sales.id
            LEFT JOIN area ON client.id_area = area.id

            GROUP BY client.name_pppoe
            ORDER BY client.name_pppoe ASC");

        return $query->result_array();
    }
}
