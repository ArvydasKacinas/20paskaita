<?php include("classes/shopDatabase-class.php"); ?>
<?php $products = new ShopDatabase(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href="assets/style.css" rel="stylesheet">
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>
    <div class="row">
    <form method="get">
        <div class="col-lg-6">
            <!-- <input class="form-control" type="text" name="sortCol" placeholder=""> -->
            <select class="form-select" name="sortCol">
                <option value="id">ID</option>
                <option value="title">Title</option>
                <option value="description">Description</option>
                <option value="price">Price</option>
                <option value="categoryTitle">Category</option>
            </select>
            <!-- <input  class="form-control" type="text" name="sortDir" placeholder=""> -->
            <select class="form-select" name="sortDir">
                <option value="ASC">ASC</option>
                <option value="DESC">DESC</option>
            </select>
            <button class="btn btn-primary" type="submit" name="sort">Sort</button>
        </div>
        <div class="col-lg-6">
        <select class="form-select" name="category_id">
            <?php $categories = $products->getCategories();
            // selected = "selected" jei pasirinkta kategorija
                foreach($categories as $category) { ?>
                    <?php if(isset($_GET["category_id"]) && $_GET["category_id"] == $category["id"] ) { ?>
                        <option value="<?php echo $category["id"] ?>" selected><?php echo $category["title"]; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $category["id"] ?>"><?php echo $category["title"]; ?></option>
                    <?php } ?>        
            <?php } ?>
        </select>
        <button class="btn btn-success" type="submit" name="filter">Filter</button>
    <a href="index.php" class="btn btn-primary">Reset</a>
        </div>
        </form>   
    </div>    
     <h6>Rodomų prekių kiekis</h6>
     <select class="form-select" name="settings">
            <?php $settings = $products->getSettings();
            // selected = "selected" jei pasirinkta kategorija && $_GET["category_id"]
                foreach($settings as $setting) { ?>
                    <?php if(isset($_GET["id"]) && $_GET["id"]== $setting["id"] ) { ?>
                        <option value="<?php echo $setting["id"] ?>" selected><?php echo $setting["name"]; ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $setting["id"] ?>"><?php echo $setting["name"]; ?></option>
                    <?php } ?>        
            <?php } ?>
        </select>
     <button class="btn btn-primary"  type="submit" name="showItems">Rodyti</button>
     <?php var_dump($products->limitChoice()); ?>
     <?php // var_dump($products->totalCount("products")[0]["totalCount"]); ?>
     <?php var_dump($products->showPagination()); ?>
     
    <table class="table table-striped">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category</th>
            <!-- <th>Actions</th> -->
        </tr>
        <?php 
            $products = $products->getProducts();

            //echo count($products);            

            foreach($products as $product) {
        ?>
            <tr>
                <td><?php echo $product["id"]; ?></td>
                <td><?php echo $product["title"]; ?></td>
                <td><?php echo $product["description"]; ?></td>
                <td><?php echo $product["price"]; ?></td>
                <td><img src="<?php echo $product["image_url"]; ?>"/></td>
                <td><?php echo $product["categoryTitle"]; ?></td>
                <!-- <td>Tuščias Žaislai vaikams</td> -->
            </tr>
        <?php }
        ?>
    </table>
</body>
</html>