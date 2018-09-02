<?php
session_start();
session_destroy();

?>
<!DOCTYPE html>
<html>
<head>
	<title>donate|NGO Panel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  

  <script type="text/javascript" src="js/typeahead.js"></script>

</head>
<body>

<div class="form-group" style="max-width: 700px; margin: 0 auto; margin-top: 20px;">
<div class="input-group">
<span class="input-group-addon">Search</span>
<input type="text" name="search" id="search"  placeholder="Search by NGO name, Area or Requirements" class="form-control" autocomplete="off">
</div>
</div>
<br>
<div id="result"></div>

</body>

</html>

<script>
 
    jQuery(document).ready(function(){

        load_data('');
        function load_data(query, typehead_search = 'yes')
        {
            
            jQuery.ajax({
                url:"fetch.php",
                method:"POST",
                data:{query:query, typehead_search:typehead_search},
                success:function(data)
                {
                    jQuery('#result').html(data);
                }
            });
        }
        jQuery('#search').typeahead({
            source:function(query,result)
            {
                jQuery.ajax({
                    url:"fetch.php",
                    method:"POST",
                    data:{query:query},
                    dataType:"json",
                    success:function(data)
                    {
                        result(jQuery.map(data,function(item){
                            return item;
                        }));
                        load_data(query, 'yes');
                    }
                });
            }
        });

    });
</script>