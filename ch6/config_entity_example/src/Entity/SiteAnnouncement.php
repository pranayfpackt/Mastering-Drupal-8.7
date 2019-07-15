<?php

namespace Drupal\config_entity_example\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * @ConfigEntityType(
 *   id ="site_announcement",
 *   label = @Translation("Site Announcement"),
 *   handlers = {
 *    "list_builder" = "Drupal\config_entity_example\SiteAnnouncementListBuilder",
 *    "form" = {
 *      "default" = "Drupal\config_entity_example\SiteAnnouncementForm",
 *      "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *    },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *    "local_action_provider" = {
 *       "collection" = "\Drupal\entity\Menu\EntityCollectionLocalActionProvider",
 *    },
 *    "local_task_provider" = {
 *       "default" = "\Drupal\entity\Menu\DefaultEntityLocalTaskProvider",
 *    },
 *   },
 *   admin_permission = "administer site_announcements",
 *   entity_keys = {
 *     "id" = "type",
 *     "label" = "label"
 *   },
 *   links = {
 *     "collection" = "/admin/site-announcements",
 *     "add-form" = "/admin/siteannouncements/add",
 *     "edit-form" = "/admin/siteannouncements/{announcement}",
 *     "delete-form" = "/admin/siteannouncements/{announcement}/delete",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "message",
 *   }
 * )
 */
class SiteAnnouncement extends ConfigEntityBase {

  /**
   * The announcement's message.
   *
   * @var string
   */
  protected $message;

  /**
   *
   */
  public function getMessage() {
    return $this->message;
  }

  /**
   *
   */
  public function setMessage($message) {
    $this->message = $message;
    return $this;
  }

}
