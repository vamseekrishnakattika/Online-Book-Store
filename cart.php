<html lang="en">
    <head>
        <meta name="description" content="Online Book Store" />
        <meta name="keywords" content="book, store, shop, books, novels, book store" />
        <meta charset="utf-8" />
        <title>Online Book Store</title>
        <link href="index.css" rel="stylesheet" type="text/css">
        <link href="favicon.ico" rel="shortcut icon" >
        <script src="js/jquery-3.1.1.min.js"></script>
        <script>
          
          function removeBtnClicked(bookId)
            {
                console.log(" in console bookid is : "+ bookId );
                $.ajax({
                    type: 'POST',
                    url: 'cookieUpdater.php', 
                    data: 'book_id='+bookId ,
                    
                    success: function (res) {
                        console.log("this is from php removeBtnClicked : "+  res);
                        window.location.reload(true);
                        
                    }
                });

        }  
        function addBtnClicked(bookId)
            {
                console.log(" in console bookid is : "+ bookId );
                $.ajax({
                    type: 'POST',
                    url: 'cookieSetter.php', 
                    data: 'book_id='+bookId ,
                    
                    success: function (res) {
                        console.log("this is from php addBtnClicked : "+  res);
                        window.location.reload(true);
                        
                    }
                });

        }  
            
        function placeOrder()
            {
                $.ajax({
                    type: 'POST',
                    url: 'order.php', 
                   
                    
                    success: function (res) {
                        //console.log("this is from php Order : "+  res);
                        //window.location.reload(true);
                         $("#results").html (res);

                    }
                });


        }  
       
            
         
         

        

        </script>
    </head>
    
    <body>
         <?php require ('php/nav.php'); 
          
            $netPrice = 0;
			$cookie_name = "book_id";
 			$data = json_decode($_COOKIE[$cookie_name]);
         ?>
        
       <div id="wrapper"> 
      
        <main style="width:70%">
         <p class="ok" id="results"></p>
             <?php
                include ('php/connect.php');
                
               
                $query =  $con->query("SELECT *  FROM books ORDER BY Title");
                 if($query->num_rows > 0)
                 {
                     while($row = $query->fetch_assoc()) 
                     {
                         if( in_array($row['Id'] , $data) )  // ($row['Id'] == $data[0] )
                         {   $bookId = $row['Id'];
                             $qty=0;
                             foreach($data as $book){
								 if($bookId==$book) $qty++;
							 }
                                $author= " SELECT   
                                                    GROUP_CONCAT(c.FirstName, ' ', c.MiddleName, ' ', c.LastName SEPARATOR ', ') author
                                            FROM    books a 
                                                    INNER JOIN authorbook b
                                                        ON a.Id = b.BookId 
                                                    INNER JOIN author c
                                                        ON b.AuthorId = c.AuthorId WHERE a.Id=$bookId";
                                $authors=mysqli_query($con,$author);
                                                            
                                $genre= " SELECT   
                                                    Name
                                            FROM    genre a 
                                                    INNER JOIN books b
                                                        ON a.GenreId = b.GenreId 
                                                    WHERE b.Id=$bookId";
                                $genres=mysqli_query($con,$genre);
                                    
                                $subgenre= " SELECT   
                                                    GROUP_CONCAT(c.Name SEPARATOR ', ') subgenre
                                            FROM    books a 
                                                    INNER JOIN subgenrebook b
                                                        ON a.Id = b.BookId 
                                                    INNER JOIN subgenre c
                                                        ON b.SubGenreId = c.SunGenreId WHERE a.Id=$bookId";
                                $subgenres=mysqli_query($con,$subgenre);

                             echo"<div class='book'>";
                            echo "<table class='bookListing'>";
                        
                                echo"<tr>";
                                echo"<td class='coverImage'><img src='img/bookcovers/".$row['CoverImage']."' class='bookCover'></td>";
                                    echo"<td colspan='3' class='description'>";
                                        echo"<h4>".$row['Title']."</h4>";
                                    echo"<h5>";
                                            while($r = mysqli_fetch_array($authors)){
                                                echo $r['0'];
                                            }
                                            
                                        echo"</h5>";
                                        echo"<p class='synopsis'>".$row['Description']."</p></td>";
                                    
                            echo"</tr>";
                            echo"<tr class='info'>";
                                    echo"<td colspan='1' class='date'>".$row['PublishDate']."</td>";
                                echo"<td colspan='3' class='genre'>";
                                
                                    while($rw = mysqli_fetch_array($genres)){
                                                echo $rw['Name']." >> ";
                                        //echo"Genre!";
                                            }
                                $i=0;
                                    while($s = mysqli_fetch_array($subgenres)){
                                                echo $s[$i];
                                        $i= $i+1;
                                        //echo"Genre!";
                                            }
                               $netPrice += $row['Price']*$qty ;
                                echo "</td>";
                    
                                echo"</tr>";
                            echo"<tr class='buy'>";
								echo"<td class='Quatity'>Quantity: ".$qty."</td>";
                                echo"<td colspan='1' class='price'>[".$row['Binding']."] $".$row['Price']."</td>";
                            echo"<td class='addButton'><input type='button' value='&#10010;' class='add' onclick='addBtnClicked(".$bookId.")' ></td>";  
                            echo"<td class='addButton'><input type='button' value='&boxh;' class='add remove' onclick='removeBtnClicked(".$bookId.")' ></td>";
                               
                                echo"</tr>";
                                echo"</table>";
                            echo"</div>";
                            
                        echo"<hr>";
                            



                         }
                  }


                 }




            ?>     
                   
        </main>
        <aside class="aside">
            
            <h4 class="right">Total</h4>
            <p class="total">
            Subtotal: <?php echo "$".$netPrice  ?> <br/>
            Tax: <?php $tax = round($netPrice*0.1 , 2) ;
            echo "$".$tax  ?>  <br/>
            Shipping: <?php if($qty>0)$shipping = 3.00;
							else $shipping = 0.00;
            echo "$".$shipping  ?>  <br/>
            </p>
            <hr>
            <p class="total bold" >
            Total:<?php $total = $netPrice + $shipping +$tax  ;
            echo "$".$total   ?> 
            </p>
            
        </aside></br>
        <?php
		if(isset($_SESSION['User'])){
            echo"<input type='button' class='order btn' value='Place Order' onclick='placeOrder()'>";
		}
            else{
			echo"<input type='button' class='order btn' value='Login' onclick=\"location.href = 'signin.php';\">";		
			}
			?>
            
            
        
        </div>
        <?php include("php/footer.php");?>
    </body>
</html>
