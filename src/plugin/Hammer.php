<?php

namespace plugin;

use pocketmine\block\Air;
use pocketmine\block\Block;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Hammer extends PluginBase implements Listener
{
    private $config;

    public function onEnable()
    {
	    $this->getServer()->getPluginManager()->registerEvents($this, $this);

        @mkdir($this->getDataFolder());

        if(!file_exists($this->getDataFolder()."config.yml")){

            $this->saveResource('config.yml');

        }

        $this->config = new Config($this->getDataFolder().'config.yml', Config::YAML);

    }

    public function onBlockBreaks(BlockBreakEvent $event)
    {
        $item = $event->getItem();
        $block = $event->getBlock();

        if ($item->getId() === $this->config->get("id")) {

            if (!$event->isCancelled()) {

                $event->setCancelled();
                $this->addBlock($block);

            }
        }

    }

    private function addBlock(Block $blocks)
    {
        $minX = $blocks->x - 1;
        $maxX = $blocks->x + 1;

        $minY = $blocks->y - 1;
        $maxY = $blocks->y + 1;

        $minZ = $blocks->z - 1;
        $maxZ = $blocks->z + 1;

        for ($x = $minX; $x <= $maxX; $x++) {

            for ($y = $minY; $y <= $maxY; $y++) {

                for ($z = $minZ; $z <= $maxZ; $z++) {

                    $block = $blocks->getLevel()->getBlockAt($x,$y,$z);

                    if ($block->getId() == Block::BEDROCK) {

                    } else {

                        $block->getLevel()->setBlock(new Vector3($x, $y, $z), new Air());

                        $item = $this->onTransform($block);
                        $block->getLevel()->dropItem(new Vector3($x, $y, $z), $item);

                    }

                }

            }

        }

    }

    public function onTransform(Block $block) : Item
    {
        switch ($block->getId()) {

            case Block::STONE:

                return Item::get(0);

                

            case Block::GRASS:

                return Item::get(0);

                

            case Block::SAND:

                return Item::get(0);

                

            case Block::PURPUR_BLOCK:

                return Item::get(0);

                

            case Block::SANDSTONE:

                return Item::get(0);

                

            case Block::LAVA:

                return Item::get(0);

                

            case Block::WATER:

                return Item::get(0);

                

            case Block::DIRT:

                return Item::get(0);

                

//Ceci est l'exemple
            case Block::COAL_ORE:

//La chance 1=le minimum 4=le maximum vous pouvez le chang??
			          $rand = mt_rand(1,4);
//Sa c'est le le nom de l'item frop apres la , le meta et ne surtout pas touche le $rand
                return Item::get(Item::COAL,0, $rand);
                
                

            case Block::DIAMOND_ORE:

                return Item::get(Item::DIAMOND);

                

            case Block::GLASS:

                return Item::get(0);
                

            case Block::SHULKER_BOX:

                 return Item::get(Item::SHULKER_BOX);


            case 17:

                return Item::get(0);

                

            case 162:

                return Item::get(0);

                

            case 246:

                return Item::get(0);

               

            case 31:

                return Item::get(0);

                

            case 175:

                return Item::get(0);

                

            case 74:

                return Item::get(Block::REDSTONE_ORE);

                

            case Block::GLASS_PANE:

                return Item::get(0);

                

            case Block::ENDER_CHEST:

                return Item::get(Item::OBSIDIAN,0, 5);

                

            case Block::ANVIL:

                return Item::get(Item::OBSIDIAN, $block->getDamage(), 5);

                

            case Block::GLOWSTONE:

                return Item::get(Item::PRISMARINE_CRYSTALS, 0, rand(1,4));

                

            case Block::SPONGE:

                return Item::get(Item::SPONGE);

                

            default:

                return Item::get($block->getID());

               

        }

    }

}
