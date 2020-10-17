<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('configDatabase2.php'); ?>
<?php
if(isset($_GET['ID'])) {
    $IDOfEditRow=$_GET['ID'];//This is the id of row that is going to be edited 
    if(isset($_POST['submit'])) {
    
        $name=isset($_POST['nameProduct'])?$_POST['nameProduct']:'';
        $price=isset($_POST['priceProduct'])?$_POST['priceProduct']:'';
        $id=isset($_POST['idProduct'])?$_POST['idProduct']:'';
        $image=isset($_POST['imageProduct'])?$_POST['imageProduct']:'';
        $category=$_POST['categoryProduct']?$_POST['categoryProduct']:"";
        $shortDes=isset($_POST['short'])?$_POST['short']:'';
        $longDes=isset($_POST['long'])?$_POST['long']:'';
    
        $sql="UPDATE products SET `name`='".$name."', `price`='".$price."', `product_id`='".$id."', `image`='".$image."',`category_id`='".$category."', `short_desc`='".$shortDes."', `long_desc`='".$longDes."' WHERE `product_id`='".$IDOfEditRow."' " ;
        if ($conn->query($sql) === true) {
            echo "Edited Succesfully successfully"; 
            echo "<span class='input-notification success png_bg'>Successful message</span>";   
        }  
        else {    
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}




?>
        
        <div id="main-content"> <!-- Main Content Section with everything -->
            
            <noscript> <!-- Show a notification if the user has disabled javascript -->
                <div class="notification error png_bg">
                    <div>
                        Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
                    </div>
                </div>
            </noscript>
            
            <!-- Page Head -->
            <h2>Welcome to edit panel, User</h2>
            <p id="page-intro">Edit Details</p>
            
            
            
            <div class="clear"></div> <!-- End .clear -->
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                <!-- MANAGE PRODUCTS WILL BE START FROM HERE -->
                <!-- WE WILL AGAIN ENTER PHP HERE TO SHOW THE PRODUCTS IN TABULAR FORM  -->
                
                

                    <div class="tab-content" id="tab2">
                    
                        <form action="#" method="post">
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
                                    <label>Name of Product</label>
                                        <input class="text-input small-input" type="text" id="small-input" name="nameProduct" required />  <!-- Classes for input-notification: success, error, information, attention -->
                                        <!-- SUCCESSFULL MSG -->
                                        <br /><small>Please enter the product name.</small>
                                </p>
                                
                                <p>
                                    <label>Price of Product</label>
                                    <input class="text-input medium-input datepicker" type="text" id="priceProduct" name="priceProduct" requierd /> <!--<span class="input-notification error png_bg">Error message</span>  -->
                                    <!-- ERROR MSG -->
                                </p>
                                
                                <p>
                                    <label>Product ID</label>
                                    <input class="text-input large-input" type="text" id="id" name="idProduct" required/>
                                </p>

                                <p>
                                    <label>Product Image</label>
                                    <input style="background-color:white;" class="text-input large-input" type="file" accept="image/*" id="image" name="imageProduct" required> 
                                </p>
                                
                                 <p>
                                    <label>Tags</label>
                                    <?php
                                    $query=mysqli_query($conn, "SELECT * FROM tags");
                                    $no_of_rows=mysqli_num_rows($query);
                                    if($no_of_rows>0) {
                                        while ($row = mysqli_fetch_array($query)) {
                                            echo '<input type="checkbox" name="checkbox1" value="1"/>';
                                            echo $row['name'];

                                        }
                                    }
                                    ?>
                                </p> 
                                
                                <p>
                                    <label>Categoty</label>              
                                    <select name="categoryProduct" class="small-input">
                                        <?php
                                        $query=mysqli_query($conn, "SELECT * FROM categories");
                                        $no_of_rows=mysqli_num_rows($query);
                                        if($no_of_rows>0) {
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo '<option value="1">'.$row['name'].'</option>';
                                                echo $row['name'];
                                            }
                                    }
                                    ?>
                                       
                                    </select> 
                                </p>
                                <p>
                                    <label>Colors</label>
                                    <?php
                                    $query=mysqli_query($conn, "SELECT * FROM colors");
                                    $no_of_rows=mysqli_num_rows($query);
                                    if($no_of_rows>0) {
                                        while ($row = mysqli_fetch_array($query)) {
                                            echo '<input type="checkbox" name="checkbox1" value="1"/>';
                                            echo $row['color_name'];

                                        }
                                    }
                                    ?>
                                </p> 

                                <p>
                                    <label>Short description of Product</label>
                                    <textarea class="text-input textarea wysiwyg" id="textarea" name="short" ></textarea>
                                </p>
                                
                                <p>
                                    <label>Long description of Product</label>
                                    <textarea class="text-input textarea wysiwyg" id="textarea" name="long" cols="79" rows="15"></textarea>
                                </p>
                                
                                <p>
                                    <input class="button" name='submit' type="submit" value="Submit" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                        </form>
                        
                    </div> <!-- End #tab2 -->        
                    
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->


            <?php   include('footer.php'); ?>