<?php
/**
// Buzz Object
// Location: 'includes/buzzObject.php'
// Function: To include the Buzz library

 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */


 
// Include the Google API Client library, and the Buzz Service wrapper
require_once "google-api-php-client/src/apiClient.php";
require_once "google-api-php-client/src/contrib/apiBuzzService.php";



// Setup the API Client, and create the Buzz client using it
$apiClient = new apiClient();
$buzz = new apiBuzzService($apiClient);


// If a oauth token was stored in the session, use that- and otherwise go through the oauth dance
if (isset($_SESSION['auth_token'])) {
  $apiClient->setAccessToken($_SESSION['auth_token']);
} else {
  // In a real application this would be stored in a database, and not in the session!
  $_SESSION['auth_token'] = $apiClient->authenticate();
}
?>