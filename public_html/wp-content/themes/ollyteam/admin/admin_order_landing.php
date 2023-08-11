<?
	get_template_part( 'admin/admin_header' );
?>
      
      <div class="content" style="margin-top:20px">
        <div class="container-xl">
          <div class="row justify-content-center">
		  

            <div class="col-12">
              <div class="card">
                <div class="card-header">
	              <h3 class="card-title">Заявки с лендинга</h3>
                </div>
                
                <table class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th>Дата заявки</th>
                          <th>Имя</th>
                          <th>Почта</th>
                          <th>Телефон</th>
                          <th>utm_source</th>
                          <th>utm_medium</th>
                          <th>utm_campaign</th>
                          <th>utm_content</th>
                          <th>utm_term</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?
                      	global $wpdb;
                      	$orders = $wpdb->get_results( "SELECT * FROM wp_olly_landing" );

						foreach ( $orders as $order ):  ?>
                        <tr>
                          <td><?echo date('j.m.Y H:i', strtotime($order->date_create));?></td>
                          <td><?=$order->name;?></td>
                          <td><?=$order->email;?></td>
                          <td><?=$order->phone;?></td>
                          <td><?=$order->utm_source;?></td>
                          <td><?=$order->utm_medium;?></td>
                          <td><?=$order->utm_campaign;?></td>
                          <td><?=$order->utm_content;?></td>
                          <td><?=$order->utm_term;?></td>
                        </tr>
						<?php endforeach; ?>
                    </table>
                
             

                
                
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





</body>
</html>