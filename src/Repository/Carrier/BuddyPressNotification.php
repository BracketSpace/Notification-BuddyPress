<?php
/**
 * BuddyPress Notification Carrier
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Carrier;

use BracketSpace\Notification\Interfaces\Triggerable;
use BracketSpace\Notification\Repository\Carrier\BaseCarrier;
use BracketSpace\Notification\Repository\Field;

/**
 * BuddyPress Notification Carrier
 */
class BuddyPressNotification extends BaseCarrier
{
	/**
	 * Carrier icon
	 *
	 * @var string SVG
	 */
	public $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" preserveAspectRatio="xMidYMid meet" enable-background="new 0 0 128 128"><g transform="translate(0,-924.36218)"><path d="m 126.5,988.37986 a 62.5,62.5 0 0 1 -124.999995,0 62.5,62.5 0 1 1 124.999995,0 z" style="fill:#ffffff" /><g transform="matrix(0.02335871,0,0,-0.02334121,-0.11965895,1052.4471)" style="fill:#d84800"><path d="M 2515,5484 C 1798,5410 1171,5100 717,4595 332,4168 110,3689 23,3105 -1,2939 -1,2554 24,2385 111,1783 363,1266 774,842 1492,102 2529,-172 3521,116 c 448,130 858,379 1195,726 413,426 667,949 751,1548 24,173 24,548 -1,715 -91,625 -351,1150 -781,1580 -425,425 -943,685 -1555,780 -101,16 -520,29 -615,19 z m 611,-143 C 4158,5186 4999,4440 5275,3435 5501,2611 5302,1716 4747,1055 4319,547 3693,214 3028,141 c -125,-14 -441,-14 -566,0 -140,15 -338,55 -468,95 C 722,621 -58,1879 161,3188 c 41,249 115,474 234,717 310,631 860,1110 1528,1330 213,70 374,102 642,129 96,10 436,-4 561,-23 z" /><path d="M 2575,5090 C 1629,5020 813,4386 516,3490 384,3089 362,2641 456,2222 643,1386 1307,696 2134,479 c 233,-61 337,-73 611,-73 274,0 378,12 611,73 548,144 1038,500 1357,986 193,294 315,629 363,995 20,156 15,513 -10,660 -42,241 -108,448 -215,665 -421,857 -1325,1375 -2276,1305 z m 820,-491 c 270,-48 512,-261 608,-537 26,-76 31,-104 35,-222 4,-115 1,-149 -17,-220 -62,-250 -237,-457 -467,-553 -63,-27 -134,-48 -134,-41 0,2 15,35 34,72 138,274 138,610 0,883 -110,220 -334,412 -564,483 -30,10 -62,20 -70,23 -21,7 77,56 175,88 126,41 255,49 400,24 z m -610,-285 c 310,-84 541,-333 595,-641 18,-101 8,-278 -20,-368 -75,-236 -220,-401 -443,-505 -109,-51 -202,-70 -335,-70 -355,0 -650,217 -765,563 -28,84 -31,104 -31,232 -1,118 3,152 22,220 89,306 335,528 650,585 67,13 257,3 327,-16 z M 4035,2940 c 301,-95 484,-325 565,-710 21,-103 47,-388 37,-414 -6,-14 -30,-16 -182,-16 -96,0 -175,3 -175,6 0,42 -37,236 -60,313 -99,334 -315,586 -567,661 -24,7 -43,17 -43,21 0,5 32,45 72,90 l 72,82 106,-6 c 67,-3 130,-13 175,-27 z m -1703,-510 258,-255 92,90 c 51,49 183,178 293,286 l 200,197 75,-9 c 207,-26 404,-116 547,-252 170,-161 267,-361 308,-632 15,-100 21,-394 9,-454 l -6,-31 -1519,0 c -1074,0 -1520,3 -1524,11 -14,21 -18,297 -6,407 59,561 364,896 866,950 97,10 55,41 407,-308 z" /></g></g></svg>'; // phpcs:ignore Generic.Files.LineLength.TooLong

	/**
	 * Carrier constructor
	 *
	 * @since 1.1.0
	 */
	public function __construct()
	{
		parent::__construct('buddypress-notification', __('BuddyPress Notification', 'notification-buddypress'));
	}

	/**
	 * Used to register Carrier form fields
	 *
	 * @return void
	 */
	public function formFields()
	{

		$this->addFormField(
			new Field\TextareaField(
				[
					'label' => __('Content', 'notification-buddypress'),
					'name' => 'content',
					'rows' => 2,
				]
			)
		);

		$this->addFormField(
			new Field\InputField(
				[
					'label' => __('Link', 'notification-buddypress'),
					'name' => 'link',
				]
			)
		);

		$this->addFormField(
			new Field\SelectField(
				[
					'label' => __('State', 'notification-buddypress'),
					'name' => 'state',
					'options' => [
						'unread' => __('Unread', 'notification-buddypress'),
						'read' => __('Read', 'notification-buddypress'),
					],
				]
			)
		);

		$this->addRecipientsField();
	}

	/**
	 * Sends the notification
	 *
	 * @param  Triggerable $trigger trigger object.
	 * @return void
	 */
	public function send(Triggerable $trigger)
	{
		/** @var array{parsed_recipients: array<int>, state: string, content: string, link: string} */
		$data = $this->data;

		foreach ($data['parsed_recipients'] as $receiverId) {
			$notificationId = bp_notifications_add_notification(
				[
					'user_id' => $receiverId,
					'component_name' => 'notification-buddypress',
					'component_action' => $trigger->getSlug(),
					'is_new' => $data['state'] === 'unread',
					'allow_duplicate' => true,
				]
			);

			if (!is_int($notificationId)) {
				continue;
			}

			bp_notifications_add_meta($notificationId, 'notification_content', $data['content']);

			// phpcs:ignore SlevomatCodingStandard.ControlStructures.EarlyExit.EarlyExitNotUsed
			if (!empty($data['link'])) {
				bp_notifications_add_meta($notificationId, 'notification_link', $data['link']);
			}
		}
	}
}
