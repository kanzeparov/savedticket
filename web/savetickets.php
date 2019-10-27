<?php 
header("Access-Control-Allow-Origin: *");
include_once 'db_conn.php';
 
$_SESSION['pin'] = $_POST['pin'];
$pin = $_POST['pin']; 

$database = new Database();
$db = $database->getConnection();
$query = "SELECT eth_address, smartcontract, event_img, event_dt, event, event_cat FROM ouchsu00_savetickets.access WHERE pin=".$pin;
?>
<!doctype html>
<html lang="en">

<head>
  <title>SaveTickets</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/babel-polyfill/dist/polyfill.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.2.1/dist/web3.min.js"></script>
  <script src="assets/js/config.js"></script>
  <script src="assets/js/smartcontract.js"></script>
  <script src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
  <script>

        if (typeof web3 !== 'undefined') {
            web3 = new Web3(web3.currentProvider);
        } else {
            // set the provider you want from Web3.providers
            alert('Please activate MetaMask Plugin and reload page! You can find it here: https://metamask.io/')
        }
		
		function addTicket() {
          let ticketName =  "<?php  echo $event_data->message->title; ?>";
          let ticketPrice = 1000;
		  let ticketOwner = "0x2A2233dFF9e7f8E6090aDB5Ea6d06723E1f62BFC"; 
		  let ticketPersonInfo = "Ivan"; 
		  let ticketPlace = "<?php echo $event_data->message->venue->title; ?>";
		  let ticketId = "661584";
		  let ticketDate = "<?php  echo $event_data->message->date; ?> ";
		  let ticketAll = "<?php  echo $event_data->message->title; echo "#"; $event_data->message->venue->title; echo "#"; echo $event_data->message->date; echo "#"; echo "661584"; ?>"
		  let user_pin = "<?php  echo $pin; ?>";
          deployConract(ticketName, ticketPrice, ticketOwner, ticketPersonInfo, ticketPlace, ticketId, ticketDate, ticketAll, user_pin);
        }
		
		function track(addr){
          //let addr = "0x2c264db63f4b96e2880a1aa176c601f3d9b0e126";
          let contract = openContract(addr);
          getStates(contract, addr);
        }
		
		function delegate_ticket(addr) {
			let addr1 = "0xB1E0472C4027c1a929b8ba4DD50F21D61c6B54d3";
			let contract = openContract(addr1);
			delegate (contract, addr1);
			//getStates(contract, addr1);
		}

        function open_t(addr) {
			//let addr = "0x2c264db63f4b96e2880a1aa176c601f3d9b0e126";
			let contract = openContract(addr);
			open_ticket (contract, addr);
			getStates(contract, addr);
		}
  
</script>
  <!--
  <form id="create_contract_content" action="">
    
        <input class = "input" id="productName" placeholder="product">
        <input class="button" id="my_button" type="button" onclick="addProduct()" value="Add to AnchorChain"><br />
    </form>
  <script src="assets/js/smartcontract.js"></script>-->
    
</head>

<body class="dark-edition">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="./assets/img/sidebar-2.jpg">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
          Save Tickets
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="javascript:void(0)">
              <i class="material-icons">mail</i>
              <p>Мои билеты</p>
            </a>
          </li>
		  <li class="nav-item active  ">
            <a class="nav-link" href="javascript:void(0)">
              <i class="material-icons">list_alt</i>
              <p>История</p>
            </a>
          </li>
		  <li class="nav-item active  ">
            <a class="nav-link" href="authorization.php">
              <i class="material-icons">person</i>
              <p>Выход</p>
            </a>
          </li>
          <!-- your sidebar here -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:void(0)">Мои билеты</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                  <i class="material-icons">monetization_on</i>
                  <p class="d-lg-none d-md-block">
                    Кошелек
                  </p>
                </a>
              </li>
              <!-- your navbar here -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            
            <?php foreach ($db->query($query) as $row) {
            $sm_ticket_id = $row['ticket_id'];
			$sm_eth_addr = $row['eth_address'];
			$sm_smartcontract = $row['smartcontract'];
			$event = $row['event'];
			$event_img = $row['event_img'];
			$event_cat = $row['event_cat'];
			$event_dt = $row['event_dt'];
            ?>
   
            <div  id="<?php  echo $sm_smartcontract; echo "---open"; ?>" class="col-xl-4 col-lg-12">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                  <div class="" id=""><img style="max-width:100%;" src="<?php echo $event_img;?>"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title"><?php  echo $event ?></h4>
                  <p class="card-category"><?php echo $event_cat ?></p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i><?php  echo $event_dt; ?> 
                  </div>
                </div>
				<!--<button onclick="addTicket();">оооо</button>
				<button onclick="track();">llll</button>-->
				<button id="<?php  echo $sm_smartcontract; echo "---open"; ?>" class="btn btn-primary btn-round" onclick='delegate_ticket("<?php  echo $sm_smartcontract;?>");'>Делегировать</button>
				<a href="#" class="btn btn-primary btn-round">Распечатать</a>
              </div>
            </div>
			
			<?php  } ?>  

          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="#">
                  StartBlock
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.startblock.online" target="_blank">StartBlock</a>.
          </div>
          <!-- your footer here -->
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="./assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-dashboard.js?v=2.1.0"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="./assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();
         
	
		 
        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });		
      });

    });
  </script>
  

</body>

</html>
