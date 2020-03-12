<?php
/**
 * Triggers
 *
 * @package notification-buddypress
 */

use BracketSpace\Notification\BuddyPress\Components\Trigger;

// Activity.
if ( notification_get_setting( 'triggers/buddypress/activity_enable' ) ) {
	notification_register_trigger( new Trigger\Activity\Added() );
	notification_register_trigger( new Trigger\Activity\Deleted() );
	notification_register_trigger( new Trigger\Activity\AddToFavorities() );
	notification_register_trigger( new Trigger\Activity\AddToFavoritiesFail() );
	notification_register_trigger( new Trigger\Activity\RemoveFromFavorities() );
}

// Friendship.
if ( notification_get_setting( 'triggers/buddypress/friendship_enable' ) ) {
	notification_register_trigger( new Trigger\Friendship\Accepted() );
	notification_register_trigger( new Trigger\Friendship\Requested() );
	notification_register_trigger( new Trigger\Friendship\Deleted() );
}

// Group.
if ( notification_get_setting( 'triggers/buddypress/group_enable' ) ) {
	notification_register_trigger( new Trigger\Group\CreateComplete() );
	notification_register_trigger( new Trigger\Group\DetailsUpdated() );
	notification_register_trigger( new Trigger\Group\SettingsUpdated() );
	notification_register_trigger( new Trigger\Group\Deleted() );

	notification_register_trigger( new Trigger\Group\InviteUser() );
	notification_register_trigger( new Trigger\Group\UninviteUser() );
	notification_register_trigger( new Trigger\Group\Join() );
	notification_register_trigger( new Trigger\Group\Leave() );
	notification_register_trigger( new Trigger\Group\RemoveMember() );

	notification_register_trigger( new Trigger\Group\BanMember() );
	notification_register_trigger( new Trigger\Group\UnbanMember() );

	notification_register_trigger( new Trigger\Group\PromoteMember() );
	notification_register_trigger( new Trigger\Group\DemoteMember() );

	notification_register_trigger( new Trigger\Group\MembershipRequested() );
	notification_register_trigger( new Trigger\Group\MembershipAccepted() );
	notification_register_trigger( new Trigger\Group\MembershipRejected() );
}
