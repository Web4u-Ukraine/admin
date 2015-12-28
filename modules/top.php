<?
if (($login=='')&&($arg2!='')){
	?>
	<script>
		window.location.replace('/');</script>
	</script>
	<?
}
?>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<i class="fa fa-cog"></i>
				</button>
  			</div>
  			<div style="float:right;margin-top:10px"><a href="/admin/logout.php">Выход <i class="fa fa-sign-out"></i></a></div>
  		</div> 
  	</nav>
  	<? if ($arg2!=''){ ?>
	<div class="subnavbar">
		<div class="subnavbar-inner">
			<div class="container">
				<a href="#" class="subnav-toggle" data-toggle="collapse" data-target=".subnav-collapse">
			      <span class="sr-only">Toggle navigation</span>
			      <i class="icon-reorder"></i>
			    </a>
	
				<div class="collapse subnav-collapse">
					<ul class="mainnav">
						<li <? if ($arg2=='news') echo 'class="active"'; ?>>
							<a href="/admin/news/">
								<i class="fa fa-newspaper-o"></i>
								<span>Новости</span>
							</a>	    				
						</li>
						
						<li class="<? if ($arg2=='partner') echo 'active'; ?>">
							<a href="/admin/partner/">
								<i class="fa fa-briefcase"></i>
								<span>Партнеры</span>
							</a>	     
						</li>
						
						<li class="<? if ($arg2=='text') echo 'active'; ?>">
							<a href="/admin/text/">
								<i class="fa fa-file-text-o"></i>
								<span>Текстыв</span>
							</a>	     
						</li>
						
						<li class="<? if ($arg2=='shedule') echo 'active'; ?>">
							<a href="/admin/shedule/">
								<i class="fa fa-list"></i>
								<span>Расписание</span>
							</a>	     
						</li>

                        <li class="<? if ($arg2=='treners') echo 'active'; ?>">
                            <a href="/admin/treners/">
                                <i class="fa fa-user"></i>
                                <span>Тренера</span>
                            </a>
                        </li>

<!--
                        <li class="<? if ($arg2=='services') echo 'active'; ?>">
                            <a href="/admin/services/">
                                <i class="fa fa-bars"></i>
                                <span>Наші послуги</span>
                            </a>
                        </li>

                        <li class="<? if ($arg2=='about_us') echo 'active'; ?>">
                            <a href="/admin/about_us/">
                                <i class="fa fa-list-alt"></i>
                                <span>Про нас</span>
                            </a>
                        </li>
-->

						<li class="<? if ($arg2=='pages') echo 'active'; ?>">
                            <a href="/admin/pages/">
                                <i class="fa fa-list"></i>
                                <span>Сторінки</span>
                            </a>
                        </li>
                        <li class="<? if ($arg2=='words') echo 'active'; ?>">
                            <a href="/admin/words/">
                                <i class="fa fa-font"></i>
                                <span>Вирази</span>
                            </a>
                        </li>
                        <li class="<? if ($arg2=='ceo') echo 'active'; ?>">
                            <a href="/admin/ceo/">
                                <i class="fa fa-cogs"></i>
                                <span>Ceo</span>
                            </a>
                        </li>
                        </ul>
				</div> <!-- /.subnav-collapse -->
	
			</div> <!-- /container -->
		
		</div> <!-- /subnavbar-inner -->
	
	</div> <!-- /subnavbar -->
	<div class="main">
    	<div class="container">
		<? } ?>