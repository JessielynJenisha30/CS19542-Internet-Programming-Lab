<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savoury Food Menu</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair Display">
    <style>
        /* Styling for the menu page */
        body {
            font-family: 'Playfair Display';
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #6b4f4f;
        }

        #menuContainer {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        #Seasonal {
            background-color: rgb(255, 221, 169);
        }

        .menuItem {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px;
            padding: 15px;
            width: 200px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .menuItem img,
        .menuItem_Seasonal img {
            width: 100%;
            height: auto;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .menuItem h3,
        .menuItem_Seasonal h3 {
            margin-top: 10px;
            color: #6b4f4f;
        }

        .menuItem p,
        .menuItem_Seasonal p {
            color: #333;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #searchBar,
        #filterDropdown,
        #sortDropdown {
            font-family: 'Playfair Display';
            padding: 10px;
            width: 100%;
            max-width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
            display: block;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .controls {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Savoury Food Menu</h1>

    <div class="controls">
        <input type="text" id="searchBar" placeholder="Search for a snack..." onkeyup="filterMenu()">
        <select id="filterDropdown" onchange="filterMenu()">
            <option value="all">All Categories</option>
            <option value="veg">Vegetarian </option>
            <option value="non-veg">Non-Vegetarian</option>
            <option value="standard">Standard</option>
            <option value="seasonal">Seasonal</option>
        </select>
        <select id="sortDropdown" onchange="sortMenu()">
            <option value="name">Sort by Name</option>
            <option value="price">Sort by Price</option>
        </select>
    </div>

    <div id="menuContainer">

        <!--?php
        $conn = new mysqli('localhost', 'root', '', 'cafe_db');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM cafe_menu WHERE category IN ('veg', 'non-veg')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="menuItem" data-category="' . $row['category'] . '" data-price="' . $row['price'] . '" type="' . $row['type'] . '">';
                echo '<img src="' . $row['img_src'] . '" alt="' . $row['alt'] . '">';
                echo '<h3>' . ucfirst($row['alt']) . '</h3>';
                echo '<p>Price: $' . $row['price'] . '</p>';
                echo '</div>';
            }
        } else {
            echo "No savory items found.";
        }

        $conn->close();
        ?> -->
        
        <!-- Menu items -->
        <div class="menuItem" data-category="veg" data-price="2.0" type="standard">
            <img src="Veg Wrap.jpg" alt="Veg Wrap">
            <h3>Veg Wrap</h3>
            <p>Price: $2.00</p>
        </div>
        <div class="menuItem" data-category="veg" data-price="2.5" type="standard">
            <img src="Mini Tacos.jpg" alt="Mini Tacos">
            <h3>Mini Tacos (5 pcs)</h3>
            <p>Price: $2.50</p>
        </div>
        <div class="menuItem" data-category="non-veg" data-price="2.5" type="standard">
            <img src="Lamb Skewer.jpg" alt="Lamb Skewers">
            <h3>Lamb Skewers (4 pcs)</h3>
            <p>Price: $2.50</p>
        </div>
        <div class="menuItem" data-category="veg" data-price="1.5" type="standard">
            <img src="Fries.jpg" alt="French Fries">
            <h3>French Fries</h3>
            <p>Price: $1.50</p>
        </div>
        <div class="menuItem" data-category="non-veg" data-price="2.5" type="standard">
            <img src="Hot Dog.jpg" alt="Stuffed Hot Dog">
            <h3>Stuffed Hot Dog</h3>
            <p>Price: $2.00</p>
        </div>
        <div class="menuItem" data-category="non-veg" data-price="3.0" type="standard">
            <img src="Chicken Salad.jpg" alt="Chicken Salad">
            <h3>Chicken Salad</h3>
            <p>Price: $3.00</p>
        </div>
        <div class="menuItem" data-category="non-veg" data-price="3.0" type="standard">
            <img src="Ramen.jpg" alt="Traditional Ramen">
            <h3>Traditional Ramen</h3>
            <p>Price: $3.00</p>
        </div>
        <div class="menuItem" data-category="non-veg" data-price="3.0" type="standard">
            <img src="Chicken Curry.jpg" alt="Curry Chicken and Rice">
            <h3>Curry Chicken and Rice</h3>
            <p>Price: $3.00</p>
        </div>
        <div class="menuItem" id="Seasonal" data-category="veg" data-price="2.0" type="seasonal">
            <img src="Tomato Soup.jpg" alt="Tomato Soup">
            <h3>Tomato Soup</h3>
            <p>Price: $2.00</p>
        </div>
        <div class="menuItem" id="Seasonal" data-category="non-veg" data-price="3.0" type="seasonal">
            <img src="Dumpling Soup.jpg" alt="Dumpling Soup">
            <h3>Dumpling Soup</h3>
            <p>Price: $3.00</p>
        </div>
    </div>

    <script>
        function filterMenu() {
            const searchInput = document.getElementById('searchBar').value.toLowerCase();
            const filterValue = document.getElementById('filterDropdown').value;
            const menuItems = document.querySelectorAll('.menuItem');

            menuItems.forEach(item => {
                const itemName = item.querySelector('h3').textContent.toLowerCase();
                const itemCategory = item.getAttribute('data-category');
                const itemType = item.getAttribute('type');

                if (
                    (filterValue === 'all' || itemCategory === filterValue || itemType === filterValue) &&
                    itemName.includes(searchInput)
                ) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function sortMenu() {
            const sortValue = document.getElementById('sortDropdown').value;
            const menuContainer = document.getElementById('menuContainer');
            const menuItems = Array.from(menuContainer.getElementsByClassName('menuItem'));

            let sortedItems;

            if (sortValue === 'name') {
                sortedItems = menuItems.sort((a, b) =>
                    a.querySelector('h3').textContent.localeCompare(b.querySelector('h3').textContent)
                );
            } else if (sortValue === 'price') {
                sortedItems = menuItems.sort((a, b) =>
                    parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price'))
                );
            }

            sortedItems.forEach(item => menuContainer.appendChild(item));
        }
    </script>
</body>

</html>