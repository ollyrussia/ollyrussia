
<?
	get_template_part( 'admin/admin_header' );
?>
      
      <div class="content" style="margin-top:20px">
        <div class="container-xl">
          <div class="row justify-content-center">
		  

            <div class="col-12">
              <div class="card">
                <div class="card-header">

                  <h3 class="card-title">Рассылка дат в канал</h3>
					<a href="#" class="btn btn-primary ms-auto btnAllMessage" data-bs-toggle="modal" data-bs-target="#modal-report">Сообщение по всем</a>
                </div>
                
                
                <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table">
                      <thead>
                        <tr>
                          <th>Психолог</th>
                          <th>Действие</th>
                          <th>Последняя отправка</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?
						$users = get_users('role=psychologist' );
										
							foreach ($users as $user) {
								echo "<tr>";
								echo "<tr>
										<td>".$user->display_name."</td>
										<td><a href='#' data-therapist='".$user->ID."' class='btn btn-success btnMessage' data-bs-toggle='modal' data-bs-target='#modal-report'>Отправить даты</a></td>
										<td>Временно недоступно</td>";
											
							}
                      ?>	

                      </tbody>
                    </table>
                  </div>
                
                </div>   
                
                
              </div>
          </div>
        </div>
      </div>
    </div>
    
    

    
    

    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Сообщение в канал</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
          	
          	<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">
			  <!-- Then put toasts within -->
				<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
				  <div class="toast-header">
				  	  <strong class="mr-auto">Ответ сервера</strong>
				      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				    </div>
				    <div class="toast-body"></div>
				  </div>
			</div>

			<form id="sendMessageBot" method="POST">
				
				<input type="hidden" name="action" value="sendMessageOllybot">
	            
					<div class="col-lg-12">
					     <div>
					         <label class="form-label">Сообщение</label>
					         <textarea id="messageBot" name="message" class="form-control" rows="17" style="margin-top: 0px; margin-bottom: 20px;"></textarea>
					      </div>
					</div>
	
	         
		          <div class="modal-footer">
		            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Закрыть</a>
		            <a href="#" id="sendMessageBtn" class="btn btn-primary ms-auto">
		              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
		              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
		              Отправить
		            </a>
		          </div>
		          
	          </form>
        </div>
      </div>
    </div>
    </div>
    
    

<script>
<?="var ajaxurl='".admin_url('admin-ajax.php')."'";?>
</script>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>
<script src="<?= bloginfo('template_directory'); ?>/admin/js/picker.min.js"></script>
<link rel="stylesheet" href="<?= bloginfo('template_directory'); ?>/admin/js/picker.min.css">

<script> 
	$(document).ready(function() {
		
		  $('.btnMessage').on('click',function(event){
		  	$('#messageBot').val();
			  $.ajax({ 
			      url: ajaxurl, 
			      type: "POST",
			      crossDomain: true,
			      data: { therapist: $(this).data('therapist'), action: "getMessageBot" }, 
			      success: function(data) 
			      {
			      	   $('#messageBot').val(data);
			      } 
			    });		  	
		  });
		
		  $('.btnAllMessage').on('click',function(event){
		  	  $('#messageBot').val();
			  $.ajax({ 
			      url: ajaxurl, 
			      type: "POST",
			      crossDomain: true,
			      data: { action: "getMessageAllBot" }, 
			      success: function(data) 
			      {
			      	   $('#messageBot').val(data);
			      } 
			    });		  	
		  });		
		
		  $('#sendMessageBtn').on('click',function(event){

		  	if ($('#messageBot').val()[0]!="!") {
		  		
		  	  $('.toast').toast('show')

			  $.ajax({ 
			      url: ajaxurl, 
			      type: "POST",
			      crossDomain: true,
			      data: $('#sendMessageBot').serialize(), 
			      success: function(data) 
			      {
			      	   $('.toast-body').text("Сообщение отправлено");
			           $('.toast').toast('show');
			      } 
			    });
			    event.preventDefault();		  		
		  	} else {
		  			$('.toast-body').text("Сообщение НЕ отправлено. Свободных окон нет.");
			        $('.toast').toast('show');	
		  	}
		  	
			

		  });
	});
</script>




</body>
</html>