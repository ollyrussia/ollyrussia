<?
	//Выход
	if( isset( $_GET['logout'] ) ) {
        wp_logout();
    }
    
	//Если неавторизован, то перебрасываем на страницу входа
	if(!is_user_logged_in() || !current_user_can('psychologist')) {
	  auth_redirect();
	 }
	 
	//Получаем текущего пользователя
	$current_user   = wp_get_current_user();
    //$wp_user   = $current_user->ID;
	
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css">
    <title>Личный кабинет психолога</title>
  </head>
  
  <body class="antialiased">
    <div class="page">
    <div id="vue-app">
      <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
           Личный кабинет психолога
          </h1>
          <div class="navbar-nav flex-row order-md-last">

            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(<?php echo esc_attr(get_the_author_meta('photo',$current_user->ID));?>)"></span>
                <div class="d-none d-xl-block ps-2">
                  <div><?php echo $current_user->user_lastname?></div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="<?php echo $_SERVER['REQUEST_URI'].'?logout=true'; ?>" class="dropdown-item">Выйти</a>
              </div>
            </div>
          </div>
        </div>
      </header>
      <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="/lk" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Календарь / заявки
                    </span>
                  </a>
                </li>
              </ul>

            </div>
          </div>
        </div>
      </div>
      <div class="content" style="margin-top:20px">
        <div class="container-xl">
          <div class="row justify-content-center">


           <div class="col-12">
              <div class="card">
                <div class="card-header">

                  <h3 class="card-title">Календарь / заявки</h3>

                 
                  <a href="#" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modal-report">Добавить</a>
                  
                </div>
                
               <div class="mb-3" style="padding:10px">
                    <label class="form-label">Тип терапии</label>
						<select name="type" class="form-select" aria-label="Default select example">
						  <option value="Основа">Основа</option>
						  <option value="Психосоматика">Психосоматика</option>
						  <option value="Психосоматика2">Психосоматика 2</option>
						  <option value="Психология/Психосоматика">Психология / Психосоматика</option>
						  <option value="Насилие/ПА">Насилие/ПА</option>
						  
					
					</select>
                </div>                
               
                <div class="list-group list-group-flush overflow-auto" style="max-height: 35rem">
	                <div id="items_crm">
	                	<div v-for="(session, index) in sessions">
	                		<div class="list-group-header sticky-top">{{ index }}</div>
	                		<div v-for="(item, index) in session">
		                		<div class="list-group-item">
		                    		<div class="row">
		                    			<div class="col-auto">
		                    				<span 
		                    					class="badge" 
		                    					v-bind:class="{
		                    						'bg-danger': item.status == 'В процессе оплаты',
		                    						'bg-success': item.status == 'Забронировано'
		                    					}"
		                    				>
		                    				</span>
		                    				</div>
		                    			<div class="col text-truncate">
		                        			<template v-if="item.status == 'Забронировано'">
		                        				<a 
		                        					data-bs-toggle="modal" data-bs-target="#modal-report1"
		                        					class="text-body d-block" 
		                        					v-on:click="selectSession(item.date, item.info)"
		                        				>
		                        					{{ item.info.fio }}
		                        				</button>
		                        			</template>
		                        			<template v-else>
		                        				{{ item.status }}
		                        			</template>
		                        			<div class="text-truncate mt-n1">{{ index }}</div>
		                    			</div>
		                    				<div class="col-auto">
		                    				<a href="#" class="del_btn" v-bind:data-id="item.id">Удалить</a>
		                    			</div>
		                    		</div>
		                		</div>
	                		</div>
	                	</div>
	                </div>
                </div>
              </div>
          </div>
		  
        </div>	
      </div>
    </div>
    
    
    <!--Информационное окно -->
 
    
    
    <!--/-->
    <div class="modal modal-blur fade" id="modal-report1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Карточка клиента</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">

<div class="col-12">
                <div class="card" v-if="selectedSession">
                  <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table">
                      <thead>
                        <tr>
                          <th>Контакт</th>
                          <th>Запрос</th>
                          <th>Дата</th>
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td data-label="Name">
                            <div class="d-flex py-1 align-items-center">
                              <div class="flex-fill">
                                <div class="font-weight-medium">{{ selectedSession.fio }}</div>
                                <div class="text-muted"><a href="#" class="text-reset">{{ selectedSession.email }}</a></div>
                                <div class="text-muted"><a href="#" class="text-reset">{{ selectedSession.phone }}</a></div>
                              </div>
                            </div>
                          </td>
                          <td data-label="Title">
                            <div>{{ selectedSession.query }}</div>
                          </td>
                          <td class="text-muted" data-label="Role">
                            {{ selectedSession.date }}
                          </td>
                          <td>

                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
</div>   

          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Закрыть
            </a>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Новая терапия</h5>
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
			<input type="hidden" name="therapist" value="<?=$current_user->ID?>">
			<input type="hidden" name="add_date" value="">
			<input type="hidden" name="action" value="add_therapy">
			
            <div class="mb-3">
              <label class="form-label">Дата</label>
              <div class="js-inline-picker"><?echo date("Y-m-d 08:00");?> </div>
            </div>

            <label class="form-label">Тип терапии</label>
			<div class="form-selectgroup-boxes row mb-3">
              <div class="col-lg-4">
                <label class="form-selectgroup-item">
                  <input type="radio" name="type" value="Основа" class="form-selectgroup-input" checked="">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Основа</span>
                    </span>
                  </span>
                </label>
              </div>
              
               <div class="col-lg-4">
                <label class="form-selectgroup-item">
                  <input type="radio" name="type" value="Психосоматика2" class="form-selectgroup-input">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Психосоматика 2</span>
                    </span>
                  </span>
                </label>
              </div>

               <div class="col-lg-4">
                <label class="form-selectgroup-item">
                  <input type="radio" name="type" value="Насилие/ПА" class="form-selectgroup-input">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Насилие/ПА</span>
                    </span>
                  </span>
                </label>
              </div>
              
              
            </div>

          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Закрыть
            </a>
            <a href="#" id="add_btn" class="btn btn-primary ms-auto">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
              Добавить терапию
            </a>
          </div>
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
		  	  $('[name="add_date"]').val(picker.getDate(true))
		  	
			  $.ajax({ 
			      url: ajaxurl, 
			      type: "POST",
			      crossDomain: true,
			      data: $('#add_form').serialize(), 
			      success: function(data) 
			      {
			      	   $('.toast-body').text(data);
			           $('.toast').toast('show')
			      } 
			    });
			    event.preventDefault();
		  });
		  
		  $(document).on('click','.del_btn',function(event){
			event.preventDefault()
			  $.ajax({ 
			      url: ajaxurl, 
			      type: "POST",
			      crossDomain: true,
			      data: {id:$(this).data('id'), action:"delTherapy"}, 
			      success: function(data) 
			      {
			      	alert(data);
			      } 
			    });
			    
		  });
		  
	});
	//Добавление терапии  
  
	var vueApp = new Vue({
		el: '#vue-app',
		data() {
			return {
				sessions: null,
				selectedSession: null
			}
		},
		methods: {
			getSessions: function() {
				$.ajax({ 
					url: ajaxurl, 
					type: "POST",
					crossDomain: true,
					dataType: 'json',
					data: {action : 'getTherapy', id_therapist: $('[name="therapist"]').val(), type:$('[name="type"]').val()},
					success: (data) => {
						this.sessions = data;
					}
				});
			},
			selectSession: function(date, info) {
				this.selectedSession = {...info, date};
			}
		},
		mounted() {
			this.getSessions();
			setInterval(() => {
				this.getSessions();
			}, 2000)
		}
	});
</script>




</body>
</html>