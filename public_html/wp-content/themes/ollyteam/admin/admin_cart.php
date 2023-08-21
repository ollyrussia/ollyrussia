
<?
	/*
	Template Name: Генерация корзины
	*/
	
	
	get_template_part( 'admin/admin_header' );

?>
      
      <div class="content" style="margin-top:20px">
        <div class="container-xl">
          <div class="row justify-content-center">
		  

            <div class="col-12">
              <div class="card">
                <div class="card-header">

                  <h3 class="card-title">Ссылки для оплаты</h3>

                  <a href="#" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modal-report">Добавить</a>
                  
                </div>
                
                
                <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table">
                      <thead>
                        <tr>
                          <th>Дата</th>
                          <th>Терапевт</th>
                          <th>Сумма</th>
                          <th>Ссылка</th>
                          <th>Статус</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?
                    		
    						$carts = $wpdb->get_results("SELECT * FROM wp_olly_cart ORDER BY id_cart DESC ");
    						
    						foreach( $carts as $cart)
    						{
    							$therapist = get_user_by('id', $cart->therapist_cart);
        						if ($therapist) {$name_therapist = $therapist->display_name;}
        						
        						$url = home_url('/cart', 'https')."?pre=".$cart->url_cart;
        						//Приводим даты в удобночитаемый вид
							    $date_ru = ruDate($cart->date_cart,false);
							    $time_ru = ruDate($cart->date_cart,true);
  
    							echo '<tr>
				                          <td data-label="Дата">'.$date_ru.' '.$time_ru.'</td>
				                          <td data-label="Терапевт">'.$name_therapist.'</td>
				                          <td data-label="Сумма">'.$cart->sum_cart.'</td>
				                          <td data-label="Ссылка"><a target="_BLANK" href="'.$url.'">'.$url.'</td>
				                          <td data-label="Статус">'.$cart->status_cart.'</td>  
                        			</tr>';
    							
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
                            <label class="form-label">Тип терапии</label>
								<select name="type_cart" class="form-select" aria-label="Default select example">
									<option value='Психология'>Психология</otion>
									<option value='Психосоматика2'>Психосоматика2</otion>
									<option value='Насилие'>Насилие</otion>
									<option value='Панические атаки'>Панические атаки</otion>
								</select>
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
							<option value="1">1</option>
						  <option value="500">500</option>
						  <option value="1000">1000</option>
						  <option value="1200">1200</option>
						  <option value="1500">1500</option>
						  <option value="2000">2000</option>
						  <option value="2100">2100</option>
						  <option value="2200">2200</option>
						  <option value="2500">2500</option>
						  <option value="2700">2700</option>
						  <option value="2800">2800</option>
						  <option value="3000">3000</option>
						  <option value="3500">3500</option>
						  <option value="4000">4000</option>
						  <option value="4200">4200</option>
						  <option value="5000">5000</option>
						  <option value="6000">6000</option>
						  <option value="6500">6500</option>
						  <option value="7000">7000</option>
						  <option value="8000">8000</option>
						  <option value="8500">8500</option>
						  <option value="9000">9000</option>
						  <option value="10000">10000</option>
						  <option value="11000">11000</option>
						  <option value="11200">11200</option>
						  <option value="12000">12000</option>
						  <option value="14000">14000</option>
						  <option value="14500">14500</option>
						  
						  <option value="16000">16000</option>
						  <option value="15000">15000</option>
						  <option value="17000">17000</option>
						  <option value="18000">18000</option>
						  <option value="20000">20000</option>
						  <option value="25000">25000</option>
						  <option value="30000">30000</option>
						  
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