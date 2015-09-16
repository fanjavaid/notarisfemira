	<?php if(isset($_GET['module'])) { ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>

	<!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Page Script -->
    <script>
      $(function () {
        // $("#example1").DataTable();
        $('#example2').DataTable({
          "iDisplayLength" : 15,
          "order" : [],
          "columns": [
		    null,
		    null,
		    null,
		    null,
        null,
		    null,
		    { "orderable": false }
		  ],
          "paging": true,
          "lengthChange": false,
          "searching": false,
          //"ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script>
    	$(document).ready(function(){
    		$('.container-fluid').fadeIn();
    	});
    </script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- All Javascript Settings -->
    <script>
    	/* Function untuk memberikan effect error pada field yang mandatory */
    	function addErrorStyle(elementName) {
			$(elementName).parent('div').addClass('has-error').addClass('has-feedback');
			$(elementName).parent('div').append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			//$(elementName).attr("placeholder","required");
		}

		/* Function untuk memberikan effect error pada field yang mandatory */
    	function removeErrorStyle(elementName) {
    		$(elementName).parent('div').removeClass('has-error')
			$(elementName).parent('div').addClass('has-success').addClass('has-feedback');
			$(elementName).parent('div').append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');

			console.log($(element).next());

			//$(elementName).attr("placeholder","required");
		}

		//function dropDownHandler() {
			$(".dropdown-menu li a").click(function(){
			  var selText = $(this).text();
			  $(this).parents('.input-group-btn').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
			});
		//}

    // Masking input element to money with options.
    VMasker(document.getElementsByClassName("currency")).maskMoney({
      // Decimal precision -> "90"
      precision: 0,
      // Decimal separator -> ",90"
      separator: ',',
      // Number delimiter -> "12.345.678"
      delimiter: '.',
      // Money unit -> "R$ 12.345.678,90"
      unit: '',
      // Money unit -> "12.345.678,90 R$"
      suffixUnit: '',
      // Force type only number instead decimal,
      // masking decimals with ",00"
      // Zero cents -> "R$ 1.234.567.890,00"
      zeroCents: false
    });

		// Call function
		//dropDownHandler();
    </script>
  </body>
</html>