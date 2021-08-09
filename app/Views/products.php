<div>
    <h1>
        Products
    </h1>
    <p>
    Show a list of all products here...
    </p>
    <table class="table" id="products">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
            </tr>
        </thead>
    <?php 
        foreach($products as $key => $value) {
           echo '<tr>';
           echo '<td>'.$value['id'].'</td>';
           echo '<td>'.$value['name'].'</td>';
           echo '<td>'.$value['category'].'</td>';
           echo '<td>'.$value['price'].'</td>';
           echo '</tr>';
        }
    ?>
    </table>

    <pre>
$q = new Query;

$q->select('*')->from('products')->orderBy(['name' => 'asc'])->all();</pre> 
   
</div>