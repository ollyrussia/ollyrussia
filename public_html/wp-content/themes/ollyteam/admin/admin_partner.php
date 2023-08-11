
<?
	/*
	Template Name: Партнерские ссылки
	*/
	
	
	get_template_part( 'admin/admin_header' );
?>
      
      <div class="content" style="margin-top:20px">
        <div class="container-xl">
          <div class="row justify-content-center">
		  

            <div class="col-12">
            	
	            <div class="card">
		            <div class="card-header">
			            <h3 class="card-title">Партнерская программа</h3>
			            <a href="#" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modal-report">Добавить партнерский код</a>
		            </div>
	            
	            
                  <div class="list-group list-group-flush">
                  	
	                    <div class="list-group-item" v-for="(session, index) in sessions">
	                      <div class="row align-items-center">
	                        <div class="col text-truncate">
	                          <a href="#" class="text-body d-block">{{ session.code }}</a>
	                          <small class="d-block text-muted text-truncate mt-n1">{{ session.description }}</small>
	                          <small><a v-bind:href="session.url" target="_BLANK">{{session.url}}</a></small>
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
</div>

    

    
    

    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Добавление нового партнера</h5>
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
				
				<input type="hidden" name="action" value="addPartner">
				
				<div class="mb-3">
	              <label class="form-label">Код партнера</label>
	              <input type="text" class="form-control" name="code" placeholder="На английском языке">
	            </div>
	            
				<div class="mb-3">
	              <label class="form-label">Описание</label>
	              <input type="text" class="form-control" name="description" placeholder="">
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
    
    <div class="modal modal-blur fade" id="modal-report1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Информация о партнере</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">

			<div class="col-12">
                <div class="card" v-if="selectedSession">
                  <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table">
                      <thead>
                        <tr>
                          <th></th>
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

		  $('#add_btn').on('click',function(event){

		  	 $('.toast').toast('show')
		  	 
		  	
			  $.ajax({ 
			      url: ajaxurl, 
			      type: "POST",
			      crossDomain: true,
			      data: $('#add_form').serialize(), 
			      success: function(data) 
			      {
			      	   $('.toast-body').text(data);
			           $('.toast').toast('show');
			           $('#add_btn').reset();
			      } 
			    });
			    event.preventDefault();
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
					data: {action : 'getPartners'},
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
			}, 3000)
		}
	});
</script>




</body>
</html>