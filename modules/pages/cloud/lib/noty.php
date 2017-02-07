  <div class="notices" style="width:400px">
        <div class="bg-color-blue">
            <a href="#" class="close"></a>
           
            <div class="notice-header fg-color-yellow"><?php if (isset($_REQUEST[title])) echo $_REQUEST[title]; else echo "";?>  </div>
            <div class="notice-text"><?php if (isset($_REQUEST[msg])) echo str_replace("_", " ", $_REQUEST[msg]); else echo "";?></div>
        </div>
    </div>