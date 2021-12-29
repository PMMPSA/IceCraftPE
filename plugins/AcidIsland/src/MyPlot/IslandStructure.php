<?php

namespace MyPlot;

use pocketmine\math\Vector3;
use pocketmine\level\ChunkManager;
use pocketmine\block\Block;
use pocketmine\level\generator\populator\Populator;
use pocketmine\utils\Random;
use pocketmine\level\generator\Generator;
use pocketmine\level\format\Chunk;

class IslandStructure extends Populator{
	public $generator = null;

	public function __construct(Generator $gen){
		$this->generator = $gen;
	}

	public static function placeObject(ChunkManager $level, $chunk, $Xofchunk, $Zofchunk){
	
		$vec = new Vector3($chunk->getX() * 16 + $Xofchunk, 0, $chunk->getZ() * 16 + $Zofchunk);	
		$vec = $vec->subtract(7, 0, 7);
		for($x = 4; $x < 13; $x++){
			for($z = 4; $z < 13; $z++){
				$level->setBlockIdAt($vec->x + $x, 65, $vec->z + $z, Block::GRASS);

				$level->setBlockIdAt($vec->x + $x, 64, $vec->z + $z, Block::SAND); //Cát

				$level->setBlockIdAt($vec->x + $x, 63, $vec->z + $z, Block::DIRT); //Đất
				$level->setBlockIdAt($vec->x + $x, 62, $vec->z + $z, Block::DIRT);
                $level->setBlockIdAt($vec->x + $x, 61, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 60, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 59, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 58, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 57, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 56, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 55, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 54, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 53, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 52, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 51, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 50, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 49, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 48, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 47, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 46, $vec->z + $z, Block::DIRT);
				
				$level->setBlockIdAt($vec->x + $x, 45, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 44, $vec->z + $z, Block::DIRT);
                $level->setBlockIdAt($vec->x + $x, 43, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 42, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 41, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 40, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 39, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 38, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 37, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 36, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 35, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 34, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 33, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 32, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 31, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 30, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 29, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 28, $vec->z + $z, Block::DIRT);
				
				$level->setBlockIdAt($vec->x + $x, 27, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 26, $vec->z + $z, Block::DIRT);
                $level->setBlockIdAt($vec->x + $x, 25, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 24, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 23, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 22, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 21, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 20, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 19, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 18, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 17, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 16, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 15, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 14, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 13, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 12, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 11, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 10, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 9, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 8, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 7, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 6, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 5, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 4, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 3, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 2, $vec->z + $z, Block::DIRT);
				$level->setBlockIdAt($vec->x + $x, 1, $vec->z + $z, Block::DIRT);
			}
		}

		for($x = 5; $x < 10; $x++){
			for($z = 5; $z < 10; $z++){
				$level->setBlockIdAt($vec->x + $x, 68, $vec->z + $z, Block::AIR); // 72
			}
		}
		for($x = 6; $x < 9; $x++){
			for($z = 6; $z < 9; $z++){
				$level->setBlockIdAt($vec->x + $x, 69, $vec->z + $z, Block::AIR); // 73
			}
		}
		 for ($x = 4; $x < 11; $x++) {
                for ($z = 4; $z < 11; $z++) {
					 for ($x = 0; $x < 16; $x++) {

					
				}}}
				$level->setBlockIdAt($vec->x + 12, 65, $vec->z + 12, Block::AIR);


$level->setBlockIdAt($vec->x + 11, 6, $vec->z + 12, Block::SUGARCANE_BLOCK);

$level->setBlockIdAt($vec->x + 11, 66, $vec->z + 12, Block::SUGARCANE_BLOCK);
$level->setBlockIdAt($vec->x + 11, 67, $vec->z + 12, Block::SUGARCANE_BLOCK);
$level->setBlockIdAt($vec->x + 10, 65, $vec->z + 12, Block::AIR);
$level->setBlockIdAt($vec->x + 12, 65, $vec->z + 11, Block::AIR);

$level->setBlockIdAt($vec->x + 8, 66, $vec->z + 9, Block::LOG);

$level->setBlockIdAt($vec->x + 11, 65, $vec->z + 11, Block::AIR);

$level->setBlockIdAt($vec->x + 12, 65, $vec->z + 10, Block::GRASS);

$level->setBlockIdAt($vec->x + 12, 65, $vec->z + 6, Block::SAND);

$level->setBlockIdAt($vec->x + 4, 65, $vec->z + 10, Block::AIR);

$level->setBlockIdAt($vec->x + 9, 66, $vec->z +8, Block::LOG);

$level->setBlockIdAt($vec->x + 4, 65, $vec->z + 11, Block::AIR);
$level->setBlockIdAt($vec->x + 4, 65, $vec->z + 12, Block::AIR);
$level->setBlockIdAt($vec->x + 10, 66, $vec->z + 6, Block::TALL_GRASS);

$level->setBlockIdAt($vec->x + 5, 65, $vec->z + 10, Block::GRASS);

$level->setBlockIdAt($vec->x + 5, 65, $vec->z + 11, Block::AIR);

$level->setBlockIdAt($vec->x + 5, 65, $vec->z + 12, Block::AIR);

$level->setBlockIdAt($vec->x + 6, 65, $vec->z + 12, Block::AIR);

$level->setBlockIdAt($vec->x + 4, 66, $vec->z + 9, Block::GRASS);


$level->setBlockIdAt($vec->x + 4, 66, $vec->z + 8, Block::GRASS);

$level->setBlockIdAt($vec->x + 4, 66, $vec->z + 7, Block::GRASS);

$level->setBlockIdAt($vec->x + 4, 66, $vec->z + 6, Block::GRASS);

$level->setBlockIdAt($vec->x + 4, 66, $vec->z + 5, Block::GRASS);
$level->setBlockIdAt($vec->x + 4, 66, $vec->z + 4, Block::GRASS);

$level->setBlockIdAt($vec->x + 5, 66, $vec->z + 4, Block::GRASS);

$level->setBlockIdAt($vec->x + 6, 66, $vec->z + 4, Block::GRASS);

$level->setBlockIdAt($vec->x + 7, 66, $vec->z + 4, Block::GRASS);

$level->setBlockIdAt($vec->x + 4, 66, $vec->z + 8, Block::GRASS);

$level->setBlockIdAt($vec->x + 7, 66, $vec->z + 5, Block::GRASS);
$level->setBlockIdAt($vec->x + 6, 66, $vec->z + 5, Block::GRASS);
$level->setBlockIdAt($vec->x + 6, 66, $vec->z + 6, Block::GRASS);

$level->setBlockIdAt($vec->x + 5, 66, $vec->z + 5, Block::GRASS);

$level->setBlockIdAt($vec->x + 5, 66, $vec->z + 6, Block::GRASS);
$level->setBlockIdAt($vec->x + 5, 66, $vec->z + 7, Block::GRASS);




		$level->setBlockIdAt($vec->x + 7, 70, $vec->z + 8, Block::LOG);
		$level->setBlockIdAt($vec->x + 8, 66, $vec->z + 7, Block::LOG);
		$level->setBlockIdAt($vec->x + 8, 67, $vec->z + 7, Block::LOG);
		
		$level->setBlockIdAt($vec->x + 10, 66, $vec->z + 8, Block::LOG);
		
		
		
		 // 5
		$level->setBlockIdAt($vec->x + 8, 67, $vec->z + 8, Block::LOG); // 6
		$level->setBlockIdAt($vec->x + 8, 68, $vec->z + 8, Block::LOG); // 7
		$level->setBlockIdAt($vec->x + 8, 69, $vec->z + 8, Block::LOG); // 8
		$level->setBlockIdAt($vec->x + 8, 70, $vec->z + 8, Block::LOG);
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 8, Block::LOG);
		 // 9
		$level->setBlockIdAt($vec->x + 4, 1, $vec->z + 10, Block::AIR);
		$level->setBlockIdAt($vec->x + 5, 68, $vec->z + 5, Block::AIR); // 72
		
		$level->setBlockIdAt($vec->x + 5, 68, $vec->z + 9, Block::AIR);
		
		$level->setBlockIdAt($vec->x + 9, 68, $vec->z + 5, Block::AIR);
		
		$level->setBlockIdAt($vec->x + 9, 68, $vec->z + 9, Block::AIR);
		###
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 6, Block::LEAVES); // 73
		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 8, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 8, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 7, Block::LEAVES);

		$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 7, Block::LEAVES);

		$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 7, Block::LEAVES);

		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 6, Block::LEAVES);
$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 7, Block::LEAVES);

		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 7, Block::LEAVES);

		$level->setBlockIdAt($vec->x + 10, 71, $vec->z + 8, Block::LEAVES);

$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 8, Block::LEAVES);

$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 8, Block::LEAVES);

$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 8, Block::LEAVES);
$level->setBlockIdAt($vec->x + 9, 71, $vec->z + 9, Block::LEAVES);

$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 9, Block::LEAVES);

$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 9, Block::LEAVES);


$level->setBlockIdAt($vec->x + 8, 72, $vec->z + 9, Block::LEAVES);

$level->setBlockIdAt($vec->x + 8, 73, $vec->z + 9, Block::LEAVES);

$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 10, Block::LEAVES);


$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 9, Block::LEAVES);
$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 8, Block::LEAVES);
$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 8, Block::LEAVES);

$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 8, Block::LEAVES);

$level->setBlockIdAt($vec->x + 6, 71, $vec->z + 8, Block::LEAVES);

$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 7, Block::LEAVES);

$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 7, Block::LEAVES);

$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 9, Block::LEAVES);

$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 9, Block::LEAVES);






		
				$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 6, Block::LEAVES); // 74
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 6, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 6, 72, $vec->z + 7, Block::LEAVES);
$level->setBlockIdAt($vec->x + 6, 71, $vec->z + 7, Block::LEAVES);

		$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 7, Block::LEAVES);
$level->setBlockIdAt($vec->x + 8, 71, $vec->z + 7, Block::LEAVES);

 		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 8, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 7, Block::LEAVES); // 75
	}

	public function populate(ChunkManager $level, $chunkX, $chunkZ, Random $random){
		$chunk = $level->getChunk($chunkX, $chunkZ);
		$shape = $this->generator->getShape($chunkX << 4, $chunkZ << 4);
		for($Z = 0; $Z < 16; ++$Z){
			for($X = 0; $X < 16; ++$X){
				$type = $shape[($Z << 4) | $X];
				if($type === MyPlotGenerator::ISLAND){
					self::placeObject($level, $chunk, $X, $Z);
				}
			}
		}
	}
}