<?php
/**
* @file
* Contains \Drupal\password_policy\Entity\PasswordPolicy.
*/

namespace Drupal\password_policy\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Entity\EntityWithPluginCollectionInterface;
use Drupal\password_policy\PasswordPolicyConstraintCollection;
use Drupal\password_policy\PasswordPolicyInterface;

/**
 * Defines a Password Policy configuration entity class.
 *
 * @ConfigEntityType(
 *   id = "password_policy",
 *   label = @Translation("Password Policy"),
 *   handlers = {
 *     "list_builder" = "Drupal\password_policy\Controller\PasswordPolicyListBuilder",
 *     "form" = {
 *       "delete" = "Drupal\password_policy\Form\PasswordPolicyDeleteForm"
 *     },
 *     "wizard" = {
 *       "add" = "Drupal\password_policy\Wizard\PasswordPolicyWizard",
 *       "edit" = "Drupal\password_policy\Wizard\PasswordPolicyWizard"
 *     }
 *   },
 *   config_prefix = "password_policy",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label"
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/security/password-policy/{machine_name}/{step}",
 *     "delete-form" = "/admin/config/security/password-policy/policy/delete/{password_policy}",
 *     "collection" = "/admin/config/security/password-policy"
 *   }
 * )
 */
class PasswordPolicy extends ConfigEntityBase implements PasswordPolicyInterface {

  /**
  * The ID of the password policy.
  *
  * @var int
  */
  protected $id;

  /**
  * The policy title.
  *
  * @var string
  */
  protected $label;

  /**
   * The number of days between forced password resets.
   *
   * @var int
   */
  protected $password_reset = 30;

  /**
   * Constraint instance IDs.
   *
   * @var array
   */
  protected $policy_constraints = [];

  /**
   * Roles to which this policy applies.
   *
   * @var array
   */
  protected $roles = [];

  /**
   * {@inheritdoc}
   */
  public function id() {
    return $this->id;
  }

  /**
   * {@inheritdoc}
   */
  public function label() {
    return $this->label;
  }

  /**
   * Return the constraints from the policy
   *
   * return @var array
   */
  public function getConstraints(){
    return $this->policy_constraints;
  }

  public function getConstraint($key) {
    if (!isset($this->policy_constraints[$key])) {
      return [];
    }
    return $this->policy_constraints[$key];
  }

  /**
   * Return the password reset setting from the policy
   *
   * return @var array
   */
  public function getPasswordReset(){
    return $this->password_reset;
  }

  public function getRoles() {
    return $this->roles;
  }
}
