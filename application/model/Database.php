<?php
  namespace application\model;

  use application\model\EnvHandler;
  use mysqli;
  
  /**
   * This class connects to the database and sends query to the database.
   * 
   *   @method customerDetails()
   *     This function is used to fetch the details of the customer from the
   *     database.
   */
  class Database {

    /**
     *   @var mysqli_object $conn
     *     Stores the object of database connection.
     */
    private $conn;

    /**
     * Constructor is used to connect to the database and store the object of
     * the database in a class variable after successfully connecting.
     * 
     *   @return void
     *     Only stores the object of the database.
     */
    public function __construct() {
      $env = new EnvHandler();
      $envArray = $env->fetchEnvValues();
      $this->conn = new mysqli($envArray["serverName"], $envArray["userName"], $envArray["password"], $envArray["dbName"]);
      if ($this->conn->connect_error) {
        die("Connection failed: " . $this->conn->connect_error);
      }
    }

    /**
     * This function is used to fetch the details of the user from the database.
     * 
     *   @param string $userName
     *     Stores the username of the user.
     *   @param string $role
     *     Stores the role of the user.
     * 
     *   @return mixed
     *     Returns an array containing the details of the user if user
     *     exists otherwise NULL.
     */
    public function userDetails(string $userName, string $role) {
      if ($role == "customer") {
        $details = "SELECT * FROM Customers WHERE username = '$userName'";
        $result = $this->conn->query($details);
        if ($result && mysqli_num_rows($result) > 0) {
          return $result->fetch_assoc();
        }  
      }
      else {
        $details = "SELECT * FROM Admins WHERE username = '$userName'";
        $result = $this->conn->query($details);
        if ($result && mysqli_num_rows($result) > 0) {
          return $result->fetch_assoc();
        }  
      }
      return NULL;
    }

    /**
     * This function is used to add book entries in the database.
     * 
     *   @param string $bookName
     *     Stores the name of the book.
     *   @param string $bookDescription
     *     Stores the description of the book.
     *   @param string $bookCost
     *     Stores the cost of the author.
     *   @param string $author
     *     Stores the name of the author.
     *   @param string $image
     *     Stores the image file path.
     * 
     *   @return bool
     *     Returns TRUE if book entry is successfully added to the database
     *     otherwise FALSE.
     */
    public function addBook(string $bookName, string $bookDescription, string $bookCost, string $author, string $image) {
      $add = "INSERT INTO Books (book_name, book_description, book_cost, author, image) VALUES ('')";
      return $this->conn->query($add);
    }
  }
