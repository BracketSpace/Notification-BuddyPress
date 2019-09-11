<?php
/**
 * Group membership requests link merge tag
 *
 * Requirements:
 * - `buddy_group` property with BP_Groups_Group group object.
 *
 * @package notification-buddypress
 */

namespace BracketSpace\Notification\BuddyPress\MergeTag\Group;

use BracketSpace\Notification\Defaults\MergeTag\UrlTag;


/**
 * Group membership requests link merge tag class
 */
class MembershipRequestsLink extends UrlTag {

	/**
	 * Merge tag constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct( array(
			'slug'        => 'group_membership_requests_link',
			'name'        => __( 'Group Membership Requests Link' ),
			'group'       => __( 'Group' ),
			'description' => 'https://example.com/my-group/admin/membership-requests/',
			'example'     => true,
			'resolver'    => function() {
				return bp_get_group_permalink( $this->trigger->buddy_group ) . 'admin/membership-requests/';
			},
		) );

	}

	/**
	 * Checks the requirements
	 *
	 * @return boolean
	 */
	public function check_requirements() {
		return isset( $this->trigger->buddy_group );
	}
}
