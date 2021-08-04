<div>
    <h1>
        Products
    </h1>
    <p>
    Show a list of all products here...
    </p>
    <div id="products">
    <?php 
        foreach($products as $key => $value) {
           echo '<div>';
           echo '<p><strong>Id:</strong> '.$value['id'].'</p>';
           echo '<p><strong>Name:</strong> '.$value['name'].'</p>';
           echo '<p><strong>Category:</strong> '.$value['category'].'</p>';
           echo '<p><strong>Price:</strong> '.$value['price'].'</p>';
           echo '</div>';
        }
    ?>
    </div>
</div>