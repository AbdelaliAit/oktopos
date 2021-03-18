<?php
$page = 'Acceuil';
if (isset($_GET['p'])) {
$page = $_GET['p'];
}?>
<div class="sidebar">
  <div class="main-menu">
    <div class="scroll">
      <ul class="list-unstyled">
        <li class="<?= $page=='Acceuil'?'active':''?>">
          <a href="javascript:void(0)"  data-url="Acceuil/index.php" class="url">
            <i class="glyph-icon iconsmind-Home">
            </i>
            Acceuil
          </a>
        </li>
     
      
        <li class="<?= $page=='warenbewegungen'?'active':''?>">
          <a href="javascript:void(0)" data-url="warenbewegungen/index.php" class="url">
            <i class="glyph-icon iconsmind-Shop-4 ">
            </i> warenbewegungen
          </a>
        </li>
   
       
       
        <li  id="Konfiguration" class="<?= $page=='einheit' || $page=='lager'  || $page=='artikel'    ?'active':''?>">
          <a href="#Konfiguration"  class="submenu">
            <i class="glyph-icon iconsmind-Gear">
            </i> Konfiguration
          </a>
        </li>
     
        
      </ul>
    </div>
  </div>
  <div class="sub-menu">
    <div class="scroll">
      
     
      <ul class="list-unstyled" data-link="Konfiguration">
       
      <li>
          <a  href="javascript:void(0)" data-url="einheit/index.php" class="url sub"> <i class="glyph-icon simple-icon-settings">
          </i>Einheit</a>
        </li>
        <li>
          <a  href="javascript:void(0)" data-url="lager/index.php" class="url sub"> <i class="glyph-icon simple-icon-home">
          </i>Lager</a>
        </li>
        <li>
          <a  href="javascript:void(0)" data-url="artikel/index.php" class="url sub"> <i class="glyph-icon simple-icon-settings">
          </i>Artikel</a>
        </li>
        
      </ul>
    </div>
  </div>
</div>