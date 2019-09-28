<?php
    include('db.php');
    $sql = "SELECT id,title,data FROM page";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>jQuery Ajax Tab with PHP & PDO</title>
    <style>
        #tabs {padding:0; margin:0; list-style-type:none;}
        #tabs li {float:left; background-color:#000; padding: 10px; border: 1px solid #fff; border-radius:8px;}
        #tabs li a { color:#fff; font-family:arial; text-decoration:none; }
        .tabs_content { width:80%; border: 1px solid gray; padding:10px;}
        .clear { clear:both; }
        #tab_about { display:none; }
        #tab_contact { display:none; }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
</head>
<body>
    
    <ul id="tabs">
    <?php foreach ($arr as $list) { ?>
        <li><a href="javascript:void(0);" onclick="tabs_click('<?php echo $list['id']; ?>')" id="<?php echo $list['id']; ?>_click"><?php echo $list['title']; ?></a></li>
        
    <?php } ?>
        
    </ul>

    <div class="clear"></div>

    <div class="tabs_content" id="tab_home">
        <?php echo $arr[0]['data']; ?>
    </div>


    <script>
    function tabs_click(type) {
        // jQuery('.tabs_content').hide();
        // jQuery('#tab_'+type).show();
        jQuery('#tabs li a').css('border-bottom','0');
        jQuery('#'+type+"_click").css({"border-bottom":"1px solid #fff", "padding-bottom":"1px"});

        jQuery.ajax({
            url:'get_data.php',
            type:'post',
            data:'id='+type,
            success:function(data) {
                // alert(data);
                jQuery(".tabs_content").html(data);
            }
        });
    }
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
</body>
</html>