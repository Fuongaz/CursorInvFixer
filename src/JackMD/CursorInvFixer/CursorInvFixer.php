<?php
declare(strict_types = 1);

namespace JackMD\CursorInvFixer;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\InventoryContentPacket;
use pocketmine\network\mcpe\protocol\InventorySlotPacket;
use pocketmine\network\mcpe\protocol\types\ContainerIds;
use pocketmine\plugin\PluginBase;

class CursorInvFixer extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	/**
	 * @param DataPacketReceiveEvent $event
	 * @priority HIGHEST
	 */
	public function onDataPacketReceiveEvent(DataPacketReceiveEvent $event){
		$pk = $event->getPacket();

		if($pk instanceof InventorySlotPacket || $pk instanceof InventoryContentPacket){
			if($pk->windowId === ContainerIds::CURSOR){
				$event->setCancelled();
			}
		}
	}
}