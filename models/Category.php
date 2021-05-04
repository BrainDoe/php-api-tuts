<?php 
  class Category{
    // DB Stuff
    private $conn;
    private $table = 'categories';

    // Properties
    public $id;
    public $name;
    public $created_at;

    // Constructor with DB
    public function __construct($db){
      $this->conn = $db;
    }

    // Get Categories
    public function read(){
      // Create query
      $query = 'SELECT 
        id, 
        name,
        created_at 
      FROM 
        ' . $this->table . '
      ORDER BY
        created_at  
      DESC';

      // Prepare stetement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

     // Read single row from the database
     public function read_single(){
      // Make query
      $query = 'SELECT
          c.id,
          c.name as category_name,
          c.created_at
        FROM
          '. $this->table . ' c
        WHERE 
          c.id = ?
        lIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);
        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->id = $row['id'];
        $this->category_name = $row['category_name'];
    }

    // Create Category
    public function create(){
      // Create query
      $query = 'INSERT INTO ' .$this->table . ' 
        SET 
          name = :name';

          // prepare statement
          $stmt = $this->conn->prepare($query);

          // Clear data
          $this->name = htmlspecialchars(strip_tags($this->name));

          // Bind data
          $stmt->bindParam(':name', $this->name);

          // Execute query
          if($stmt->execute()){
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Update Category
    public function update(){
      // update query
      $query = 'UPDATE ' .$this->table . ' 
        SET 
          name = :name
        WHERE 
          id = :id';

          // prepare statement
          $stmt = $this->conn->prepare($query);

          // Clear data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()){
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
    // Delete Category
    public function delete(){
      // Delete query 
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind data
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()){
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      return false;
    }
  }