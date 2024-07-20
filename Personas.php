<?php
class Personas
{
  private $conexion;
  private $table = "personas";

  public $id;
  public $foto;
  public $nombre;
  public $telefono;
  public $latitud;
  public $longitud;

  // Constructor de la clase personas
  public function __construct($db)
  {
    $this->conexion = $db;
  }

  // Create
  public function createPerson()
  {
    $consulta = "INSERT INTO 
                " . $this->table . "
                SET
                foto = :foto,
                nombre = :nombre,
                telefono = :telefono,
                latitud = :latitud,
                longitud = :longitud";

    $comando = $this->conexion->prepare($consulta);

    // Sanitización
    $this->foto = htmlspecialchars(strip_tags($this->foto));
    $this->nombre = htmlspecialchars(strip_tags($this->nombre));
    $this->telefono = htmlspecialchars(strip_tags($this->telefono));
    $this->latitud = htmlspecialchars(strip_tags($this->latitud));
    $this->longitud = htmlspecialchars(strip_tags($this->longitud));

    // bind data
    $comando->bindParam(":foto", $this->foto);
    $comando->bindParam(":nombre", $this->nombre);
    $comando->bindParam(":telefono", $this->telefono);
    $comando->bindParam(":latitud", $this->latitud);
    $comando->bindParam(":longitud", $this->longitud);

    if ($comando->execute()) {
      return true;
    }

    return false;
  }

  // Read
  public function getListPersons()
  {
    $consulta = "SELECT * FROM " . $this->table . "";

    $comando = $this->conexion->prepare($consulta);

    $comando->execute();

    return $comando;
  }

  // Read by id
  public function getPersonById($id) {
    $query = "SELECT * FROM " .$this->table . " WHERE id = ?";

    $stmt = $this->conexion->prepare($query);

    $stmt->bindParam(1, $id);

    $stmt->execute();

    return $stmt;
  }

  // Update
  public function updatePerson()
  {
    $consulta = "UPDATE " . $this->table . "
                SET
                foto = :foto,
                nombre = :nombre,
                telefono = :telefono,
                latitud = :latitud,
                longitud = :longitud
                WHERE id = :id";

    $comando = $this->conexion->prepare($consulta);

    // Sanitización
    $this->foto = htmlspecialchars(strip_tags($this->foto));
    $this->nombre = htmlspecialchars(strip_tags($this->nombre));
    $this->telefono = htmlspecialchars(strip_tags($this->telefono));
    $this->latitud = htmlspecialchars(strip_tags($this->latitud));
    $this->longitud = htmlspecialchars(strip_tags($this->longitud));
    $this->id = htmlspecialchars(strip_tags($this->id));

    // bind data
    $comando->bindParam(":foto", $this->foto);
    $comando->bindParam(":nombre", $this->nombre);
    $comando->bindParam(":telefono", $this->telefono);
    $comando->bindParam(":latitud", $this->latitud);
    $comando->bindParam(":longitud", $this->longitud);
    $comando->bindParam(":id", $this->id);

    if ($comando->execute()) {
      return true;
    }

    return false;
  }

  // Delete
  public function deletePerson()
  {
    $consulta = "DELETE FROM " . $this->table . " WHERE id = :id";

    $comando = $this->conexion->prepare($consulta);

    $this->id = htmlspecialchars(strip_tags($this->id));

    $comando->bindParam(":id", $this->id);

    if ($comando->execute()) {
      return true;
    }

    return false;
  }
}
?>
