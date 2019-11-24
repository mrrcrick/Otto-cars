Uber Car discount plugin 

Instructions 
copy the clean_air_plan folder into your WordPress plugin directory i.e \wordpress\wp-content\plugins.
Login into WordPress open the WordPress admin page, select Plugins. find the clean_air_plan plugin and activate it.

To use the Plugin, create a WordPress page, insert the following shortcode [clean_air_plan].
Options you can specify the maximum number of cars per row i.e show 2 cars per row full screen.
The default is 3.
Use the maxrows parameter 
[clean_air_plan maxrows=1]in this example only 1 car will be displayed on every row.

This plugin will generate a list of cars the list will include a photo, the weekly price and a discount calculator.
To calculate the discount the user inputs their Uber Clean Air Fund. 
The user will then be shown the discount.

The list of cars are generated from the agreements.json file.
The picture of the cars are in the assets/images folder. They are named after each agreement ID from the JSON file.
i.e a car with the id agreement_KNPH should have a picture called agreement_KNPH.png.

	


