<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Resume</title>
</head>
<body>
<div>
<h1>Shopping List</h1>
<hr>
    <div style="margin: 0 auto;display: block;width: 500px;">
        <table width="100%" border="1">

        <tr>
            <td>
              <strong>ID</strong>
            </td>
            <td>
              <strong>Course Name</strong>
            </td>
            <td>
              <strong>Price ($)</strong>
            </td>
        </tr>

        <?php 
            $total = 0;
            foreach ($items as $item) {

              $total = $total + $item['price'];

              echo '
                  <tr>
                    <td>
                    '.$item['id'].' 
                    </td>
                    <td>
                      '.$item['name'].' 
                    </td>
                    <td>
                      '.$item['price'].'
                    </td>
                  </tr>
                  '; 

            }
                  
                    ?>

        </table>
          <br>
          <br>
    
      <h4>Subtotal: $ <?php echo $total ?></h4>
      <h4>Shipping: $10</h4>
      <h4>Total (Inc. taxes): <?php echo $total+10 ?></h4>

    </div>

          </div>
</body>
</html>


<html>


