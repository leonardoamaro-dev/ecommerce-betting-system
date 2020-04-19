<!-- HEADER - CREDITS: VECTOR e LEONARDO AMARO -->

<header class="section page-header" data-preset="{&quot;title&quot;:&quot;Header&quot;,&quot;category&quot;:&quot;header&quot;,&quot;reload&quot;:true,&quot;id&quot;:&quot;header&quot;}">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap novi-background">
        <nav class="rd-navbar rd-navbar-top-panel-lightnav rd-navbar rd-navbar-top-panel-light rd-navbar-original rd-navbar-fullwidth" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-fullwidth" data-xl-device-layout="rd-navbar-fullwidth" data-xxl-layout="rd-navbar-fullwidth" data-xxl-device-layout="rd-navbar-fullwidth" data-lg-stick-up-offset="90px" data-xl-stick-up-offset="90px" data-xxl-stick-up-offset="90px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true" data-stick-up-clone="true">
            <div class="rd-navbar-inner">
                <!-- RD Navbar Nav-->
                <div class="rd-navbar-nav-wrap toggle-original-elements">
                    <ul class="rd-navbar-nav">
                        <li class="active"><a href="#about-us">PESQUISA</a></li>
                        <li class=""><a href="#our-mission">COMO FUNCIONA ?</a></li>
                        <li><a href="#services">CONTATO</a></li>
                    </ul>
                </div>
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                    <button class="rd-navbar-toggle toggle-original" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                    <!-- RD Navbar Brand-->
                    <div class="rd-navbar-brand">
                        <a class="brand-name" href="http://clickspeedy/"><img src="" alt="" width="151" height="49"></a>
                    </div>
                </div>
                <!-- RD Navbar Top Panel-->
                <div class="rd-navbar-top-panel toggle-original-elements">
                    <div class="rd-navbar-top-panel-toggle toggle-original" data-rd-navbar-toggle=".rd-navbar-top-panel"><span></span></div>
                    <div class='rd-navbar-top-panel-content'>
                        <ul class='inline-list-xxs'>
                            <li>
                                <a class='icon novi-icon icon-xs icon-gray-6 fab fa-instagram' href='#'></a>
                            </li>
                            <li>
                                <a class='icon novi-icon icon-xs icon-gray-6 fab fa-facebook' href='#'></a>
                            </li>
                            <li>
                                <a class='icon novi-icon icon-xs icon-gray-6 fab fa-twitter' href='#'></a>
                            </li>
                            <li>
                                <a class='icon novi-icon icon-xs icon-gray-6 fab fa-google-plus' href='#'></a>
                            </li>
						</ul>
					<?php
					//CASO ESTEJA LOGADO APARECE O MENU LOGADO
					if (isset($_SESSION['login'])) {
						$member_id = $_SESSION['login'];
						$queryMember = "SELECT * FROM user WHERE id = '$member_id'";
						if($resultCompras = $conn->query($queryMember)) {
						   $row = $resultCompras->fetch_assoc();
						   echo "<ul class='rd-navbar-nav'><li class='active'><i class='fas fa-user'></i>";
						   echo "<a href='' style='margin-left: 8px;'>" . $row['nome'] . " " . $row['sobrenome'] . "</a></li></ul>";	
						}
						
						$queryCompras = "SELECT * FROM compras WHERE member_id = '$member_id'";
                        echo"<div class='rd-navbar-nav-wrap__shop'><a class='icon novi-icon fl-bigmug-line-shopping202 link-primary' href='../compras/'><i class='fas fa-shopping-cart'></i>";
						//BAIXA A QUANTIDADE DE PRODUTOS COMPRADO PELO CLIENTE
						if($resultCompras = $conn->query($queryCompras)) {
						   echo $resultCompras->num_rows;
						}

						echo "</a></div></div>";
                    }
					else {
						echo "<a class='btn btn-sm btn-primary btn-effect-ujarak' href='../cadastro'>Criar Conta</a>";
						echo "<a class='btn btn-sm btn-primary btn-effect-ujarak' style='margin-left: 2px;' href='../login'>Login</a>";
					}
					?>			
                </div>
            </div>
        </nav>
    </div>
</header>