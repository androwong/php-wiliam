               </div>
            </div>
            <footer class="sticky-footer bg-white">
               <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                     <span>Copyright &copy; <?php echo ucfirst($_SERVER['HTTP_HOST']); ?> <?php echo DATE('Y') ?></span>
                  </div>
               </div>
            </footer>
         </div>
      </div>
      <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
      </a>
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <script src="js/sb-admin.min.js"></script>
      <script src="js/java.js"></script>
      <!-- dataTable js -->
      <script src="vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
      <script>
      $(document).ready(function() {
         $('#dataTable').DataTable();
      });
      </script>
   </body>
</html>
