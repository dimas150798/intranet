<footer class="py-4 bg-light mt-auto" id="footer">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-center small">
                        <div>Copyright &copy; My Infly Networks 2022</div>
                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- JS dataTables -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap5.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>assets/demo/chart-area-demo.js"></script>
        <script src="<?php echo base_url(); ?>assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>assets/js/datatables-simple-demo.js"></script>

        <!-- JS Website -->
        <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

        <script type="text/javascript">
            setTimeout(function(){
                location.reload();
            },2000);
        </script>



        <!-- loading Screen-->
        <script type="text/javascript">
        $(document).ready(function() {
    
        setTimeout(function() {
            $('#ctn-preloader').addClass('loaded');
            // Una vez haya terminado el preloader aparezca el scroll
            $('body').removeClass('no-scroll-y');

            if ($('#ctn-preloader').hasClass('loaded')) {
                // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
                $('#preloader').delay(1000).queue(function() {
                $(this).remove();
                });
            }
        }, 3000);
        
        });
        </script>

        <!-- AOS -->
        <script src="<?php echo base_url(); ?>assets/js/aos.js" ></script>

        <!-- AOS -->
        <script>
        AOS.init({
            easing: 'ease-in-out-sine'
        });
        </script>

        <script>
        function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
            }
        }
        }
        </script>
        
    </body>
</html>