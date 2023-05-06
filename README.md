# vkIntershipPublicAPI
 RESTful public API for saving and getting statistics.

# Description
 The event includes the event title, user's auth status, user's IP address, and date. API uses MySQL database to store events.
 The API is developed in PHP (using OOP and Routing technologies, supports JSON and PHP associative array to in) and provides two methods:
 
 1. Method for saving events. The method takes the event title and user's auth status, and adds the date and user's IP address. The event is then stored in the database.

 2. Method for getting statistics. The method is used to filter and aggregate events stored in the database according to the specified parameters (date, event name, etc.).

# Installing the API
 1. Clone the repository to your local machine.
 2. Set up the database in MySQL and /app/utils/Database.php file.
 3. Run the API using a local server (for example, for Open Server you need to move the cloned repository to the OSPanel/domains installation path).
 4. Use API Methods.

# Already hosted public API
 To test and use the public API use the link: http://internship-api.atwebpages.com/.
 Contains a page with forms for saving and receiving statistics.

# Using the API methods
 1. Method for saving events. At http://internship-api.atwebpages.com/save/ you can send JSON or PHP associative array to save statistics (POST).
  Required data:
  query_name: "EventTitle",
  user_auth_status: 1, (where 1, "1", "on", true, "true" means True)

 2. Method for getting statistics. At http://internship-api.atwebpages.com/response/ you can send JSON or PHP associative array and get JSON data for getting statistics (POST).
  Required data:
  filter: "by_query_name", (options: by_query_name, by_date, by_user_ip, by_user_auth_status)
  value: "test", (filter value)

# An example of using API on Node.js with Axios
 First you need to download Node.js and initialize the project with the command: npm init.
 Next, create the index.js file and download Axios: npm install Axios.
 
 index.js:
  const axios = require('axios').default

  // Save events
  axios.post("http://internship-api.atwebpages.com/save", {
    query_name: "test",
    user_auth_status: 1,
  }).then(response => {
    console.log(response)
  }).catch(error => {
    console.error(error)
  })

  // Get statistics
  axios.post("http://internship-api.atwebpages.com/response", {
    filter: "by_query_name",
    value: "test",
  }).then(response => {
    console.log(response)
  }).catch(error => {
    console.error(error)
  })