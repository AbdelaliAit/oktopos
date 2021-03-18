<nav class="navbar fixed-top">
    <a href="#" class="menu-button d-none d-md-block">
        <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
            <rect x="0.48" y="0.5" width="7" height="1"/>
            <rect x="0.48" y="7.5" width="7" height="1"/>
            <rect x="0.48" y="15.5" width="7" height="1"/>
        </svg>
        <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
            <rect x="1.56" y="0.5" width="16" height="1"/>
            <rect x="1.56" y="7.5" width="16" height="1"/>
            <rect x="1.56" y="15.5" width="16" height="1"/>
        </svg>
    </a>
    <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
            <rect x="0.5" y="0.5" width="25" height="1"/>
            <rect x="0.5" y="7.5" width="25" height="1"/>
            <rect x="0.5" y="15.5" width="25" height="1"/>
        </svg>
    </a>
     <button class="header-icon btn btn-empty  d-sm-inline-block" type="button" id="Pullnav" >
                <i class="iconsmind-Arrow-LeftinCircle" style="font-size: 20px"></i>
                
                </button>
                
                <button class="header-icon btn btn-empty  d-sm-inline-block" type="button" id="Pushnav" >
                <i class="iconsmind-Arrow-RightinCircle" style="font-size: 20px"></i>
                
                </button>
   <!--  <div class="search" data-search-path="Layouts.Search03d2.html?q=">
        <input placeholder="Search...">
        <span class="search-icon">
            <i class="simple-icon-magnifier"></i>
        </span>
    </div> -->
    <a class="navbar-logo" href="javascript:void(0)">
        <span class="logo d-none d-xs-block"></span>
        <span class="logo-mobile d-block d-xs-none"></span>
    </a>
    <div class="ml-auto">
        <div class="header-icons d-inline-block align-middle">
            
            <div class="position-relative d-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="simple-icon-grid"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right  position-absolute" id="iconMenuDropdown">
                    
                    <li>
                        <a href="javascript:void(0)" class="icon-menu-item expoert">
                            <i class="glyph-icon iconsmind-Data-Save d-block"></i> Exporter BD
                        </a>
                        
                      
                        
                    </li>
                </div>
            </div>
          
                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                <i class="simple-icon-size-fullscreen"></i>
                <i class="simple-icon-size-actual"></i>
                </button>
                
                
            </div>
            <div class="user d-inline-block">
               


                <a class="header-icon btn btn-empty  d-sm-inline-block" href="<?php echo BASE_URL."logout.php" ?>">
                    <i class="simple-icon-login"> </i>
                </a>
                
            </div>
        </div>
    </div>
</nav>