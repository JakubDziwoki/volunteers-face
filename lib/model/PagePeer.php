<?php



/**
 * Skeleton subclass for performing query and update operations on the 'page' table.
 *
 *
 *
 * This class was autogenerated by Propel 1.6.7 on:
 *
 * Sat May 18 13:22:50 2013
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lib.model
 */
class PagePeer extends BasePagePeer
{

	public static function getPages() {
		$c = new Criteria();
		
		return self::doSelect($c);
	}

	public static function parsePages() {
		$pages = self::getPages();
		foreach($pages as $page) {
			$eventsList = Facebook::get()->getPageEvents($page->getFacebookId(), $page->getAccessToken());
			$events = array();

			foreach ($eventsList as $_event) {


				$event = new Event();
				if(isset($_event['name']))
					$event->setName($_event['name']);

				if(isset($_event['start_time']))
					$event->setStart($_event['start_time']);

				if(isset($_event['end_time']))
					$event->setEnd($_event['end_time']);

				if(isset($_event['timezone']))
					$event->setTimezone($_event['timezone']);

				if(isset($_event['location']))
					$event->setLocation($_event['location']);

				if(isset($_event['id']))
					$event->setFacebookId($_event['id']);

				if(isset($_event['id']))
					$event->setPicture("http://graph.facebook.com/".$_event['id']."/picture");

				if(isset($_event['description']))
					$event->setDescription($_event['description']);

				$event->setPage($page);
				$events[] = $event;
			}
		}
		return $events;
	}
}
