
<?
	/*
	Template Name: Админские отчеты
	*/
	
	
	get_template_part( 'admin/admin_header' );

	if (!$_POST)
	{
		$_POST['year']=2022;
		$_POST['month']=1;
		
	}
	
?>
	
      <div class="content" style="margin-top:20px">
        <div class="container-xl">
          <div class="row justify-content-center">
		  

            <div class="col-12">
              <div class="card">
                <div class="card-header">

                  <h3 class="card-title">Общий отчет по терапиям</h3>
				</div>
				
				<form action="/base_report/" method="POST" >
	               <div class="mb-3" style="padding:10px">
	                    <label class="form-label">Месяц</label>
							<select name="month" class="form-select" aria-label="Default select example">
							  <option value="1" <?php if($_POST['month'] == '1') {echo "selected";}?>>Январь</option>
							  <option value="2" <?php if($_POST['month'] == '2') {echo "selected";}?>>Февраль</option>
							  <option value="3" <?php if($_POST['month'] == '3') {echo "selected";}?>>Март</option>
							  <option value="4" <?php if($_POST['month'] == '4') {echo "selected";}?>>Апрель</option>
							  <option value="5" <?php if($_POST['month'] == '5') {echo "selected";}?>>Май</option>
							  <option value="6" <?php if($_POST['month'] == '6') {echo "selected";}?>>Июнь</option>
							  <option value="7" <?php if($_POST['month'] == '7') {echo "selected";}?>>Июль</option>
							  <option value="8" <?php if($_POST['month'] == '8') {echo "selected";}?>>Август</option>
							  <option value="9" <?php if($_POST['month'] == '9') {echo "selected";}?>>Сентябрь</option>
							  <option value="10" <?php if($_POST['month'] == '10') {echo "selected";}?>>Октябрь</option>
							  <option value="11" <?php if($_POST['month'] == '11') {echo "selected";}?>>Ноябрь</option>
							  <option value="12" <?php if($_POST['month'] == '12') {echo "selected";}?>>Декабрь</option>
						</select>
	                </div>
	               <div class="mb-3" style="padding:10px">
	                    <label class="form-label">Год</label>
							<select name="year" class="form-select" aria-label="Default select example">
							  <option value="2020" <?php if($_POST['year'] == '2020') {echo "selected";}?>	>2020<option>
							  <option value="2021" <?php if($_POST['year'] == '2021') {echo "selected";}?>	>2021</option>
							  <option value="2022" <?php if($_POST['year'] == '2022') {echo "selected";}?>	>2022</option>
						</select>
	                </div>	                
                  <button type="submit" class="btn btn-primary" style="margin-left:10px">Показать</button>
                </form>
                     
                <h3 style="padding:10px">Отчет</h3>

                

				
				 <?php 
				 $users = get_users('role=psychologist' );
				 foreach ($users as $user): ?>
				 
	                <div class="table-responsive"">
	                    <table class="table table-vcenter table-mobile-md card-table">
	                      <thead>
	                        <tr>
	                          <th style="width: 25%" ><b><?=$user->display_name;?></b></th>
	                          <th style="width: 25%">Тип терапии</th>
	                          <th style="width: 25%">Количество</th>
	                        </tr>
	                      </thead>
	                      <tbody>
 						<?
 						    $reports = $wpdb->get_results($wpdb->prepare("SELECT wp_olly_booking.status,MONTH(date_event),COUNT(status) as `counter`,wp_olly_booking.type
								FROM wp_olly_booking
								WHERE wp_olly_booking.therapist = %d
								AND MONTH(wp_olly_booking.date_event)=%d
								AND YEAR(wp_olly_booking.date_event)=%d
								AND wp_olly_booking.status = 'Забронировано'
								GROUP BY wp_olly_booking.type
								ORDER BY wp_olly_booking.date_event",$user->ID,$_POST['month']),$_POST['year']);

    						foreach( $reports as $report): ?>

    								<tr>
    									  <td></td>
				                          <td data-label="Тип"><?=$report->type;?></td>
				                          <td data-label="Количество"><?=$report->counter;?></td>

                        			</tr>
   
    						<?php endforeach; ?>
    						

    								
    					<?php endforeach; ?>

 					

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
            <h5 class="modal-title">Добавить новую корзину</h5>
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

			<form id="add_form" method="POST">
				
				<input type="hidden" name="action" value="addPrecart">
				<input type="hidden" name="date" value="">
				
	            
				<div class="mb-3">
	              <label class="form-label">Дата</label>
	              <div class="js-inline-picker"><?echo date("Y-m-d 08:00");?> </div>
	            </div>
	            
               <div class="mb-3">
                            <label class="form-label">Терапевт</label>
								<select name="therapist" class="form-select" aria-label="Default select example">
									<?
										
										$users = get_users('role=psychologist' );
										
										foreach ($users as $user) {
											
											echo "<option value='".$user->ID."'>".$user->display_name."</otion>";
											
										}
									
									?>
								</select>
                </div>
	               
               <div class="mb-3">
                    <label class="form-label">Сумма</label>
						<select name="sum" class="form-select" aria-label="Default select example">
						  <option value="500">500</option>
						  <option value="1000">1000</option>
						  <option value="1500">1500</option>
						  <option value="2000">2000</option>
						  <option value="2100">2100</option>
						  <option value="2200">2200</option>
						  <option value="2500">2500</option>
						  <option value="2700">2700</option>
						  <option value="2800">2800</option>
						  <option value="3000">3000</option>
						  <option value="4000">4000</option>
						  <option value="4200">4200</option>
						  <option value="5000">5000</option>
						  <option value="6000">6000</option>
						  <option value="8000">8000</option>
						  <option value="9000">9000</option>
						  <option value="10000">10000</option>
						  <option value="12000">12000</option>
						  <option value="14000">14000</option>
						  <option value="16000">16000</option>
						  <option value="15000">15000</option>
						  <option value="17000">17000</option>
						  <option value="18000">18000</option>
					</select>
                </div> 	                
	
	         
		          <div class="modal-footer">
		            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Закрыть</a>
		            <a href="#" id="add_btn" class="btn btn-primary ms-auto">
		              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
		              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
		              Добавить
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
		
		var picker= new Picker(document.querySelector('.js-inline-picker'), {
		    controls: true,
		    format: 'YYYY-MM-DD HH:mm',
		    headers: true,
		    inline: true,
		    title: 'Выберите дату и время',
		    increment: {
		    minute: 5,
		    },
		});
		
		  $('#add_btn').on('click',function(event){

		  	 $('.toast').toast('show')
		  	  $('[name="date"]').val(picker.getDate(true))
		  	
			  $.ajax({ 
			      url: ajaxurl, 
			      type: "POST",
			      crossDomain: true,
			      data: $('#add_form').serialize(), 
			      success: function(data) 
			      {
			      	   $('.toast-body').text(data);
			           $('.toast').toast('show');
			           window.location.reload();
			      } 
			    });
			    event.preventDefault();
		  });
	});
</script>




</body>
</html>