<?php
/**
 * Created by PhpStorm.
 * User: Diana
 * Date: 3/28/2019
 * Time: 9:09 PM
 */

namespace Model;

use Database\DBConnection;

class Car implements CrudInterface
{
    private $id;
    private $color;
    private $brand;
    private $seats;

    function __construct(array $properties = [])
    {
        if(isset($properties['id'])){
            $this->id = $properties['id'];
        }

        if(isset($properties['color'])){
            $this->color = $properties['color'];
        }

        if(isset($properties['brand'])){
            $this->brand = $properties['brand'];
        }

        if(isset($properties['seats'])){
            $this->seats = $properties['seats'];
        }
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;

    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param mixed $seats
     * @return Car
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;
        return $this;
    }


    public function create(): int
    {
        $connection = DBConnection::getConnection();
        $stmt = $connection->prepare('INSERT INTO car(color, brand, seats) VALUE (:color, :brand, :seats)');

        $stmt->bindParam('color', $this->color);
        $stmt->bindParam('brand', $this->brand);
        $stmt->bindParam('seats', $this->seats);

        if(!$stmt->execute()){
            throw new \LogicException($stmt->errorInfo()[2]);
        }
        return $connection->lastInsertId();

    }

    public static function read(int $id)
    {
        $connection = DBConnection::getConnection();

        $stmt = $connection->prepare("SELECT * FROM car WHERE id=:id");
        $stmt->bindParam(':id', $id);

        if(!$stmt->execute()){
            throw new \LogicException($stmt->errorInfo()[2]);
        }
        return $stmt->fetchObject(static::class);
    }

    public static function findAll(): array
    {
        // Get the connection to the database
        $connection = DBConnection::getConnection();
        // Create a statement
        $stmt = $connection->prepare('SELECT * FROM car');
        // Execute and store the result in an array
        if(!$stmt->execute()){
            throw new \LogicException($stmt->errorInfo()[2]);
        }
        //return the array

        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public function update(): bool
    {
        $connection = DBConnection::getConnection();
        $stmt = $connection->prepare('UPDATE car SET color =:color, brand =:brand, seats = :seats WHERE id =:id');

        $stmt->bindParam('id',$this->id);
        $stmt->bindParam('color', $this->color);
        $stmt->bindParam('brand', $this->brand);
        $stmt->bindParam('seats', $this->seats);

        return $stmt->execute();
    }

    public function delete(): bool
    {
        $connection = DBConnection::getConnection();
        $stmt = $connection->prepare ('DELETE FROM car WHERE id=:id');
        return $stmt->execute(['id'=>$this->id]);
    }
}