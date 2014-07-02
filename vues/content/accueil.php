<!-- debut de l'enssemble des articles (idées) -->
<article class="enssemble-articles">
   <article class="col-xs-12 col-md-8">
      <?php
         // cette boucle va afficher les articles (idées).

         for ($i = 0;$i < 6; $i++) {
         
         ?>
      <article class="col-xs-12 col-sm-6 col-md-6 idee">
         <!-- le thumbnail -->
         <div class="thumbnail">
            <a href="http://www.google.fr" ><img src=<?php echo $image[$i]; ?> alt="image application"></a>
            <div class="caption">
               <h4><?php echo $titre[$i]; ?></h4>
               <a href="http://www.google.fr" >
                  <!-- contenu du thumbnails -->
                  <p><?php echo coupeChaineArticle($contenu[$i]); ?></p>
               </a>
               <!-- les icones du thumbnails -->
               <div class="thumbs-up btnThumbs">
                  <input class='like' type="text" name="statistiques" value="3" disabled>
               </div>
               <div class="eye-open btnThumbs">
                  <input type="text" name="statistiques" value="3" disabled>
               </div>
               <div class="comment btnThumbs">
                  <input type="text" name="statistiques" value="3" disabled>
               </div>
               <div class="star btnThumbs">
               </div>
               <!-- bouton lire la suite -->
               <a href="#" class="btn btn-default consultez" role="button">Consultez
               </a>
            </div>
         </div>
      </article>
      <?php
         }
         
         ?>
   </article>
   <!-- col-xs-12  -->
</article>
<aside>
   <!-- debut aside  -->
   <aside class="col-md-4 visible-md visible-lg">
      <ul class="list-group">
         <li class="list-group-item active">STATISTIQUES ACTUELLES</li>
         <li class="list-group-item">
            <span class="badge">2500</span>
            Nombre d'idées actuellement
         </li>
         <li class="list-group-item">
            <span class="badge">1500</span>       
            Nombre d'inventeurs
         </li>
         <li class="list-group-item"> 
            <span class="badge">4012</span>
            Nombre de bailleurs de fonds
         </li>
      </ul>
   </aside>
   <!-- file actualité -->
   <aside class="col-md-4 visible-md visible-lg">
      <div class="panel-group" id="accordion">
         <div class="panel">
            <div class="panel-heading">
               <h1 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#plusLu">LES PLUS LUS</a>
               </h1>
            </div>
            <div id="plusLu" class="panel-collapse collapse in">
               <div class="panel-body">
                  <ul>
                     <li><a href="#">Tijdsbifbdufv suefvcuiw</a><small> - publié le 12/10/2014</small></li>
                     <li><a href="#">Tijdsbifbdufv suef vcuiw</a><small> - publié le 12/10/2014</small></li>
                     <li><a href="#">Tijdsbifbdufv suefvcuiw</a><small> - publié le 12/10/2014</small></li>
                     <li><a href="#">Tijdsbifbdufv suefvcuiw</a><small> - publié le 12/10/2014</small></li>
                     <li><a href="#">Tijdsbifbdufv suefvcuiw</a><small> - publié le 12/10/2014</small></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="panel">
            <div class="panel-heading">
               <h1 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#plusPartage">LES PLUS PARTAGÉS</a>
               </h1>
            </div>
            <div id="plusPartage" class="panel-collapse collapse">
               <div class="panel-body">
                  <ul>
                     <li><a href="#">Tijdsbifbdufv suefvcuiw</a><small> - publié le 12/10/2014</small></li>
                     <li><a href="#">Tijdsbifbdufv suef vcuiw</a><small> - publié le 02/10/2014</small></li>
                     <li><a href="#">Tijdsbifbdufv suefvcuiw</a><small> - publié le 12/08/2013</small></li>
                     <li><a href="#">Tijdsbifbdufv suefvcuiw</a><small> - publié le 12/10/2012</small></li>
                     <li><a href="#">Tijdsbifbdufv suefvcuiw</a><small> - publié le 12/10/2014</small></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="panel">
            <div class="panel-heading">
               <h1 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#plusCommente">LES PLUS COMMENTÉS</a>
               </h1>
            </div>
            <div id="plusCommente" class="panel-collapse collapse">
               <div class="panel-body">
                  <ul>
                     <li><a href="#">Tijdsbifbdufv suefvcuiw</a><small> - publié le 12/10/2014</small></li>
                     <li><a href="#">Tijdsbifbdufv suef vcuiw</a><small> - publié le 12/10/2014</small></li>
                     <li><a href="#">Tijdsbifbdufv suefvcuiw</a><small> - publié le 12/10/2014</small></li>
                     <li><a href="#">Tijdsbifbdufv suefvcuiw</a><small> - publié le 12/10/2014</small></li>
                     <li><a href="#">Tijdsbifbdufv suefvcuiw</a><small> - publié le 12/10/2014</small></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </aside>
   <!-- articles populaires -->
   <aside class="col-md-4 visible-md visible-lg">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title">ARTICLES LES PLUS POPULAIRES</h3>
         </div>
         <div class="panel-body">
            <?php
            // cette boucle va afficher les articles (idées).

             for ($i = 0;$i < 4; $i++) {
         
             ?>
            <div class="media">
               <a class="pull-left" href="#">
               <img class="media-object" src="./img/pic1.png" alt="image 1">
               </a>
               <div class="media-body">
                  <h5 class="media-heading"><?php echo $titreArtPopul[$i]; ?></h5>
                  <?php echo coupeChaineTitrePopul($contenuArtPopul[$i]); ?> 
                  <a href="#" class="btn-default" role="button"> <span class="glyphicon glyphicon-comment"></span> 15</a> 
               </div>
            </div>
            <?php
               
               }
            
            ?>
         </div>
      </div>
   </aside>
   <!-- sondage -->
   <aside class="col-md-4 visible-md visible-lg">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title">SONDAGE DU MOIS</h3>
         </div>
         <div class="panel-body sondage">
            <form action="#">
               <p>
                  Qu'en pensez vous de l'application Zoom8 ?
               </p>
               <input type="radio" name="sondage" id="btn1" value="btn1" checked="checked"> 
               <label for="btn1"> Excellent application</label>
               <input type="radio" name="sondage" id="btn2" value="btn2">
               <label for="btn2">  Bonne application</label>
               <input type="radio" name="sondage" id="btn3" value="btn3">
               <label for="btn3"> Trés mauvaise application</label>
               <input class="btn btn-default" type="submit" name="sondage" id="btn4" value="Valider">
            </form>
         </div>
      </div>
      <ul class="reseau-social">
         <li><a href="#" title="Facebook"><i class="fa fa-facebook fa-2x"></i></a></li>
         <li><a href="#" title="Twitter"><i class="fa fa-twitter fa-2x"></i></a></li>
         <li><a href="#" title="LinkedIn"><i class="fa fa-linkedin fa-2x"></i></a></li>
         <li><a href="#" title="Google+"><i class="fa fa-google-plus fa-2x"></i></a></li>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user fa-2x"></i> 
            <i class="fa fa-chevron-down"></i>
            </a>
            <ul class="dropdown-menu">
               <li><a href="#">Connexion</a></li>
               <li><a href="#">Inscription</a></li>
               <li><a href="#">Mon compte</a></li>
               <li class="divider"></li>
               <li><a href="#">Déconnexion</a></li>
            </ul>
         </li>
      </ul>
   </aside>
</aside>
<!-- fin aside -->
</div>
<!-- fin contenu -->