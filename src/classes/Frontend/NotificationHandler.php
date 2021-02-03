<?php
/**
 * Notification handler
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Frontend;

/**
 * NotificationHandler class
 */
class NotificationHandler {

	/**
	 * Registers BuddyPress Component.
	 *
	 * @filter bp_notifications_get_registered_components
	 *
	 * @since  [Next]
	 * @param  array $components Registered components.
	 * @return array
	 */
	public function register_component( $components = [] ) {
		array_push( $components, 'notification-buddypress' );

		return $components;
	}

	/**
	 * Displays BuddyPress notification.
	 *
	 * @filter bp_notifications_get_notifications_for_user
	 *
	 * @since  [Next]
	 * @param  string $content               Notification content.
	 * @param  int    $item_id               Notifiable item ID.
	 * @param  int    $secondary_item_id     Notifiable secondary item ID.
	 * @param  int    $total_items           Total items.
	 * @param  string $format                Notification format.
	 * @param  string $component_action_name Component action name.
	 * @param  string $component_name        Component name.
	 * @param  int    $id                    Notification ID.
	 * @return void
	 */
	public function handle_notification( $content, $item_id, $secondary_item_id, $total_items, $format = 'string', $component_action_name, $component_name, $id ) {

		if ( 'notification-buddypress' !== $component_name ) {
			return;
		}

		$text = bp_notifications_get_meta( $id, 'notification_content', true );
		$link = bp_notifications_get_meta( $id, 'notification_link', true );

		if ( 'string' === $format ) {
			if ( $link ) {
				$content = '<a href="' . $link . '">' . $text . '</a>';
			} else {
				$content = $text;
			}
		} else {
			$content = [
				'text' => $text,
				'link' => $link,
			];
		}

		return $content;

	}

}
