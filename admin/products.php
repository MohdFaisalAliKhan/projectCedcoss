<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('configDatabase2.php'); ?>
<?php
if(isset($_POST['submit'])) {
    $name=isset($_POST['nameProduct'])?$_POST['nameProduct']:'';
    $price=isset($_POST['priceProduct'])?$_POST['priceProduct']:'';
    $id=isset($_POST['idProduct'])?$_POST['idProduct']:'';
    $image=isset($_POST['imageProduct'])?$_POST['imageProduct']:'';
    $category=$_POST['categoryProduct']?$_POST['categoryProduct']:"";
    $shortDes=isset($_POST['short'])?$_POST['short']:'';
    $longDes=isset($_POST['long'])?$_POST['long']:'';
    
    $sql="INSERT INTO products(`name`, `price`, `product_id`, `image`,`category_id`, `short_desc`, `long_desc`) VALUES ('".$name."', '".$price."', '".$id."', '".$image."', '".$category."', '".$shortDes."', '".$longDes."')" ;
    if ($conn->query($sql) === true) {
        echo "New record created successfully"; 
        echo "<span class='input-notification success png_bg'>Successful message</span>";   
    }  
    else {    
        echo "Error: " . $sql . "<br>" . $conn->error;
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
            <h2>Welcome John</h2>
            <p id="page-intro">What would you like to do?</p>
            
            <ul class="shortcut-buttons-set">
                
                <li><a class="shortcut-button" href="#"><span>
                    <img src="resources/images/icons/pencil_48.png" alt="icon" /><br />
                    Write an Article
                </span></a></li>
                
                <li><a class="shortcut-button" href="#"><span>
                    <img src="resources/images/icons/paper_content_pencil_48.png" alt="icon" /><br />
                    Create a New Page
                </span></a></li>
                
                <li><a class="shortcut-button" href="#"><span>
                    <img src="resources/images/icons/image_add_48.png" alt="icon" /><br />
                    Upload an Image
                </span></a></li>
                
                <li><a class="shortcut-button" href="#"><span>
                    <img src="resources/images/icons/clock_48.png" alt="icon" /><br />
                    Add an Event
                </span></a></li>
                
                <li><a class="shortcut-button" href="#messages" rel="modal"><span>
                    <img src="resources/images/icons/comment_48.png" alt="icon" /><br />
                    Open Modal
                </span></a></li>
                
            </ul><!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Content box</h3>
                    
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
                        <li><a href="#tab2">Add</a></li>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                <!-- MANAGE PRODUCTS WILL BE START FROM HERE -->
                <!-- WE WILL AGAIN ENTER PHP HERE TO SHOW THE PRODUCTS IN TABULAR FORM  -->
                
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                        <div class="notification attention png_bg">
                            <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                This is a Fontent Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
                            </div>
                        </div>
                        
                        <table>
                            
                            <thead>
                                <tr>
                                   <th><input class="check-all" type="checkbox" /></th>
                                   <th>Name</th>
                                   <th>Price</th>
                                   <th>Category</th>
                                   <th>Color</th>
                                   <th>Image</th>
                                   <th>Product ID</th>
                                   <th>Short Description</th>
                                   <th>Long Description</th>
                                   <th>Action</th>
                                </tr>
                                
                            </thead>
                         
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="bulk-actions align-left">
                                            <select name="dropdown">
                                                <option value="option1">Choose an action...</option>
                                                <option value="option2">Edit</option>
                                                <option value="option3">Delete</option>
                                            </select>
                                            <a class="button" href="#">Apply to selected</a>
                                        </div>
                                        
                                        <div class="pagination">
                                            <a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
                                            <a href="#" class="number" title="1">1</a>
                                            <a href="#" class="number" title="2">2</a>
                                            <a href="#" class="number current" title="3">3</a>
                                            <a href="#" class="number" title="4">4</a>
                                            <a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
                                        </div> <!-- End .pagination -->
                                        <div class="clear"></div>
                                    </td>
                                </tr>
                            </tfoot>


                            <?php

                            echo "<tbody id='tableBody'>";
                            $data = "SELECT * FROM products" ;
                            $check=mysqli_query($conn, $data);
                            $no_of_rows = mysqli_num_rows($check);//returns the number of rows
    
                            if ($no_of_rows > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_array($check)) //to fetch a row as an associative array.
                                 { 
                                    
                                    echo "<tr>";
                                        echo "<td><input type='checkbox' /></td>";
                                        echo "<td>".$row['name']."</td>";
                                        echo "<td>".$row['price']."</td>";
                                        echo "<td>".$row['product_id']."</td>";
                                        echo "<td>";
                                        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="100" width="100"/>';
                                        echo "</td>";
                                        echo "<td>".$row['category_id']."</td>";
                                        echo "<td>".$row['short_desc']."</td>";
                                        echo "<td>".$row['long_desc']."</td>";
                                
                                     echo "<td>";
                                            //<!-- Icons -->
                                            echo "<a href='#' title='Edit'><img src='resources/images/icons/pencil.png' alt='Edit' /></a>";
                                            echo"<a href='#' title='Delete'><img src='resources/images/icons/cross.png' alt='Delete' /></a>"; 
                                            echo "<a href='#' title='Edit Meta'><img src='resources/images/icons/hammer_screwdriver.png'alt='Edit Meta' /></a>";
                                     echo "</td>";
                                    echo "</tr>";
                                    echo "</tbody>";
                                }
                            } else {
                                echo "Record not found..";
                            }  
                             
                            ?>
                         </table>
                        
                    </div> <!-- End #tab1 -->
                    
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
                                
                                <!-- <p>
                                    <label>Radio buttons</label>
                                    <input type="radio" name="radio1" /> This is a radio button<br />
                                    <input type="radio" name="radio2" /> This is another radio button
                                </p> --> 
                                
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

            <!-- Start Notifications -->
            
            <!-- <div class="notification attention png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
                </div>
            </div>
            
            <div class="notification information png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
                </div>
            </div>
            
            <div class="notification success png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
                </div>
            </div>
            
            <div class="notification error png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
                </div>
            </div> -->
            
            <!-- End Notifications -->
            
            <?php   include('footer.php'); ?>