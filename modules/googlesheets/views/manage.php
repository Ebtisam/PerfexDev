<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
    <div class="row">
    <div class="col-md-12">
    <div class="panel-s">
    <div class="panel-body">
    <!--<iframe dir='rtl' src="https://docs.google.com/spreadsheets/d/1sv1NmOpxX_X5almqZz9aKelQ9-JETGtcOgnsHIUkGzI/edit?usp=sharing&language=ar" style="height: 100vh; width: 100%;">></iframe>-->
    <!--<iframe dir='rtl' style="height: 100vh; width: 100%;" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR9ymf-AjTkchf2IuYjvjjX7YSg3aJhku4pSeXbabr2uKGgih0A3gptWnoLSxwarlBTjBfdTtrA3UvI/pubhtml?widget=true&amp;headers=false&language=ar"></iframe> -->
        <body>
        <table>
        <?php 
      
         /*   foreach($data as $row)
            {
                echo "<tr>";
                foreach($row as $d)
                {
                    echo "<td>";
                    echo $d;
                    echo "</td>";

                }
                echo "</tr>";
            }
            */


                foreach ($files as $file)
                {
                    echo $file->getName();
                    echo "<br>";
                    echo $file->getId();
                    echo "<br>";
                }
            
      
  ?>
        
        </table>

    </div>
    </div>

    </div>
    </div>
    </div>
</div>

<script>

</script>
