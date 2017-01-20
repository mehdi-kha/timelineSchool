<?php 
	session_start();
if(!isset($_SESSION['pseudo']))
	header('Location: /index.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<?php
	if(!isset($_GET['id']))
		header('Location: /Menu/menu.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>timeline photo</title>
    <script src="javascript.js"></script>
    
	<script type="text/javascript" src="./fancybox/lib/jquery-1.10.2.min.js"></script>
	
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="./fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="./fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
	
	<!-- Add Materialize -->
		  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>  
	 <link rel="stylesheet" type="text/css" href="style_timeline.css" />
</head>
<body>
<header>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="row">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#ds-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="ds-navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="">Timeline-photos</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<!----button to go back to Menu or log out----->
						<li class="sign-in"><a href="/Menu/menu.php" class="btn btn-default"><b>back to Menu</b></a></li>
						<li class="sign-in"><a href="/quitter.php" class="btn btn-default"><b>log out</b></a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</header>

<div id="main">
	<div id="blog" style="padding: 20px 0">
		<?php
		// to get the name of evenement
         		$pseudo = $_SESSION['pseudo'];
			$db = pg_connect("dbname=timelinephoto"); 
         		$query="SELECT nomevenement FROM evenement WHERE id=".$_GET['id'].";";
			$result = pg_query($db,$query);
			$nomevenement = pg_fetch_row($result);
		?>
		<div class="container title"><?=$pseudo?></div>
					<div class="container">
				<!-------the left container to show timeline------->
				<div class="left">
					<div class="post" id="timeline">
						<div class="post-title">
							<h2><a href="#timeline"><?=$nomevenement[0]?></a></h2>
						</div>
						<div class="post-content">
							<ul class="timeline">
							     <?php
		                              $query="SELECT id,nomperiode,heuredebut FROM periode WHERE idevenement=".$_GET['id']." ORDER BY heuredebut;";			
               		               $periode = pg_query($db,$query);
               		               $i=1;
               		               $j=0;
	                                   while ($row_periode = pg_fetch_row($periode)) {			//parcours des periodes
	                                        $query="SELECT urlphoto FROM photo WHERE idperiode=".$row_periode[0]." AND valide='true';";
				                         $result = pg_query($db,$query);
				                         $row = pg_fetch_row($result);
	                                        if(($i%2)==1) {
	                                   ?>
	                                   <!------the left blocks along timeline--->
								<li class="timeline-inverted">
									<div class="timeline-badge"></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-date"><?=$row_periode[2]?></h4>
											<h5 class="timeline-title"><?=$row_periode[1]?></h5>
										</div>
										<div class="timeline-body">
                                                       <a href="/Upload_Zip/Photo/<?=$row[0]?>"  data-fancybox-group="gallery" class="fancybox_<?=$row_periode[1]?>">
                                                       <div id="bandeau_<?=$row_periode[1]?>" class="bandeau" style="position:relative;height:220px;border:1px solid black;overflow:hidden;">&nbsp;</div>
                                                       </a>
                                                       <div id='<?=$row_periode[1]?>' class='periode'>
				                                   <img src="/Upload_Zip/Mini/<?=$row[0]?>" display="none" height='0'/>
				                                   <?php
				                                   	$j++;
					                                   while ($row = pg_fetch_row($result)) {
					                                   	$j++;
				                                   ?>
					                              <a href="/Upload_Zip/Photo/<?=$row[0]?>"  data-fancybox-group="gallery" class="fancybox_<?=$row_periode[1]?>">
					                              </a>
						                         <img src="/Upload_Zip/Mini/<?=$row[0]?>"  display="none" height='0'/>
						          
				                                   <?php } ?>
			                                        </div>
										</div>
									</div>
								</li>
								<?php }
								else {?>
								<!------the right blocks along timeline------>
								<li>
									<div class="timeline-badge"></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-date" h4-inverted><?=$row_periode[2]?></h4>
											<h5 class="timeline-title"><?=$row_periode[1]?></h5>
										</div>
										<div class="timeline-body">
                                                       <a href="/Upload_Zip/Photo/<?=$row[0]?>"  data-fancybox-group="gallery" class="fancybox_<?=$row_periode[1]?>">
                                                       <div id="bandeau_<?=$row_periode[1]?>" class="bandeau" style="position:relative;margin:0px 0px 0px 0px;height:220px;border:1px solid black;overflow:hidden;">&nbsp;</div>
                                                       </a>
                                                       <div id='<?=$row_periode[1]?>' class='periode'>
				                                   <img src="/Upload_Zip/Mini/<?=$row[0]?>" display="none" height='0'/>
				                                   <?php
				                                   	$j++;
					                                   while ($row = pg_fetch_row($result)) {
					                                   	$j++;
				                                   ?>
					                              <a href="/Upload_Zip/Photo/<?=$row[0]?>"  data-fancybox-group="gallery" class="fancybox_<?=$row_periode[1]?>">
					                              </a>
						                         <img src="/Upload_Zip/Mini/<?=$row[0]?>"  display="none" height='0'/>
				                                   <?php } ?>
			                                        </div>
										</div>
									</div>
								</li>
								<?php 
								} $i++;}
								?>
							</ul>
						</div>
					</div>
				</div>
				<!------the right container show statisque informations of this evenement----->
				<div class="right">
					<div class="post pad10">
						<div class="widget">
							<div class="widget-title"><font color="#888">Inf</font><font color="#aaa">orm</font><font color="#ccc">at</font><font color="#eee">ion</font></div>
							<div class="post-content">
								<div>
									<ul>
										<?php
										$nomFichier = $_SESSION['profil'];
										?>
										<img src="/modifProfil/profilePicture/<?=$nomFichier?>" onerror="this.src='/imagesDuSite/Icon-user.png'" alt="profile"></img>
										<li style="line-height: 40px;white-space: nowrap;font-size: 15px">Pseudo : <?=$pseudo?></li>
										<li style="line-height: 40px;white-space: nowrap;font-size: 15px">Evenement : <?=$nomevenement[0]?></li>
										<li style="line-height: 40px;white-space: nowrap;font-size: 15px">Nombre de periodes : <?=$i-1?></li>
										<li style="line-height: 40px;white-space: nowrap;font-size: 15px">Nombre total de photos : <?=$j?> </li>
									
									</ul>
								</div>
							     <p> </p>
							     <h3>
								<p >Welcome to our website!</p>
								<p></p>
								<p >Enjoy your photos!</p>
								</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
	     </div>
     </div>
</div>
   

<div class="bg skrollable skrollable-between" data-0="transform: translate(0px, 0px)" data-end="transform: translate(0, -60px)" style="transform: translate(0px, 0px);"></div>
<div class="bg-overlay skrollable skrollable-between" data-0="height: 60px" data-600="height: 150px" style="height: 60px;"></div>
<script>
    window.onload=function() {
    	var periode = document.getElementsByClassName("periode");		//utilisé pour récupérer le nom des periodes
        for(var i=0;i<periode.length;i++) {								//pour chaque periode
        	$('.fancybox_'+periode[i].id).fancybox();					//mise en place des fancybox 
        	defilImgVrt('bandeau_'+periode[i].id,1,60,periode[i].id);	//mise en place de la rotation des images, DEFAULT VALUE 1,50
        }
    }
</script>
</body>
</html>