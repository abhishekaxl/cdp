<?php declare(strict_types = 1);

namespace Drupal\cdp_tool\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\AlertCommand;
/**
 * Provides a CDP Tool form.
 */
final class CDPToolSelect extends FormBase {

  protected $step = 1;

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'cdp_tool_c_d_p_tool_select';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    // Add a wrapper for Ajax.
    $form['#prefix'] = '<div id="custom-multistep-form-wrapper">';
    $form['#suffix'] = '</div>';

    // Check the current step
    switch ($this->step) {
      case 1:
        $form = $this->buildStepOne($form);
        break;

      case 2:
        $form = $this->buildStepTwo($form);
        break;
      case 3:
        $form = $this->buildStep3($form);
        break;
      case 4:
        $form = $this->buildStep4($form);
        break;
      case 5:
        $form = $this->buildStep5($form);
        break;
      case 6:
        $form = $this->buildStep6($form);
      break;
      case 7:
        $form = $this->buildStep7($form);
        break;
      case 8:
        $form = $this->buildStep8($form);
        break;
      case 9:
        $form = $this->buildStep9($form);
        break;
      case 10:
        $form = $this->buildStep10($form);
        break;
      case 11:
        $form = $this->buildStep11($form);
        break;
      case 12:
        $form = $this->buildStep12($form);
        break;
      case 13:
        $form = $this->buildStep13($form);
        break;
      case 14:
        $form = $this->buildStep14($form);
        break;
      case 15:
        $form = $this->buildStep15($form);
        break;
      case 16:
        $form = $this->buildStep16($form);
        break;
      case 17:
        $form = $this->buildStep17($form);
        break;
      case 18:
        $form = $this->buildStep18($form);
        break;
      default:
        break;
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    // @todo Validate the form here.
    // Example:
    // @code
    //   if (mb_strlen($form_state->getValue('message')) < 10) {
    //     $form_state->setErrorByName(
    //       'message',
    //       $this->t('Message should be at least 10 characters.'),
    //     );
    //   }
    // @endcode
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $values = $form_state->getValues();
    $element = $form_state->getTriggeringElement();

    if (isset($element['#value']) && $element['#value']->render() === "PREV") {
      $this->step--;
    }else {
      $this->step++;
    }
 
    if (isset($element['#value']) && $element['#value']->render() === "No") {
      $this->step = 11;
    }
    if (isset($values['user_data_primary_goal']) && $element['#value']->render() !== "PREV") {
      if ($values['user_data_primary_goal'] === '0') {
        $this->step = 12;
      }
      if ($values['user_data_primary_goal'] === '1') {
        $this->step = 17;
      }
      if ($values['user_data_primary_goal'] === '2') {
        $this->step = 16;
      }
    }

    $form_state->setRebuild();
  }

  /**
   * Ajax submit callback.
   */
  public function ajaxSubmitCallback(array &$form, FormStateInterface $form_state) {
    return $form;
  }

  /**
   * Build the first step of the form.
   */
  private function buildStepOne(array $form) {

    $form['email'] = [
      '#type' => 'email',
      '#title' => t('Email'),
      '#prefix' => $this->t('Before we get started, what is your email address and company name?'),
    ];

    // Company Name textfield
    $form['company_name'] = [
      '#type' => 'textfield',
      '#title' => t('Company Name'),
    ];

    // Industry select list
    $form['industry'] = [
      '#type' => 'select',
      '#title' => t('Industry'),
      '#options' => ['option1' => 'Option 1', 'option2' => 'Option 2'], // Add your industry options
      '#prefix'=> $this->t('Select your industry and company size'),
    ];

    // Company Size select list
    $form['company_size'] = [
      '#type' => 'select',
      '#title' => t('Company Size'),
      '#options' => ['small' => 'Small', 'medium' => 'Medium', 'large' => 'Large'], // Add your size options
    ];

    // Always include a submit button to advance to the next step
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];

    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStepTwo(array $form) {
    $form['markup'] = [
      '#markup' => '<p>You have customer data, but do you need a CDP? Get started to find out</p>',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Get Started'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep3(array $form) {
    $form['markup'] = [
      '#markup' => '<p>Do you have a lot of customer data?</p>',
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('No'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Yes'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep4(array $form) {
    $form['markup'] = [
      '#markup' => '<p>What’s your primay goal? Select as many
      as applicable.</p>',
    ];
    $form['cdp_primary_goal'] = array(
      '#type' => 'checkboxes',
      '#name' => 'cdp_primary_goal',
      '#title' => t('Options'),
      '#options' => array(
        'Customer Analytics & Insights' => $this->t('Customer Analytics & Insights'),
        'Lead Scoring' => $this->t('Lead Scoring'),
        'Website Personalization' => $this->t('Website Personalization'),
        'Hyper Personalized Multichannel Campaigns' => $this->t('Hyper Personalized Multichannel Campaigns'),
        'Collect & Analyze Customer Data and Act Upon Feedback' => $this->t('Collect & Analyze Customer Data and Act Upon Feedback'),
      ),
    );
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep5(array $form) {
    $form['markup'] = [
      '#markup' => '<p>Have you used Data Management & Analytic (DMA)
      tools like Power BI and Apache Spark?</p>',
    ];
    $form['options'] = array(
      '#type' => 'radios',
      '#title' => t('Options'),
      '#options' => array(
        'Yes' => $this->t('Yes'),
        'No' => $this->t('No'),
      ),
    );
    $form['text'] = array(
      '#type' => 'textarea',
      '#title' => t('If yes, share the details'),
    );
    $form['markup2'] = [
      '#markup' => '<p>Are you getting value from your existing solution?</p>',
    ];
    $form['options2'] = array(
      '#type' => 'radios',
      '#title' => t('Options'),
      '#options' => array(
        'Yes' => $this->t('Yes'),
        'No' => $this->t('No'),
        'NA' => $this->t('NA'),
      ),
    );
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep6(array $form) {
    $form['markup'] = [
      '#markup' => '<p>Have you used CRM or any Marketing Automation Tools?</p>',
    ];
    $form['options'] = array(
      '#type' => 'radios',
      '#title' => t('Options'),
      '#options' => array(
        'Yes' => $this->t('Yes'),
        'No' => $this->t('No'),
      ),
    );
    $form['text'] = array(
      '#type' => 'textarea',
      '#title' => t('If yes, share the details'),
    );
    $form['markup2'] = [
      '#markup' => '<p>Are you getting value from your existing solution?</p>',
    ];
    $form['options2'] = array(
      '#type' => 'radios',
      '#title' => t('Options'),
      '#options' => array(
        'Yes' => $this->t('Yes'),
        'No' => $this->t('No'),
        'NA' => $this->t('NA'),
      ),
    );
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep7(array $form) {
    $form['markup'] = [
      '#markup' => '<p>Have you used any Personalization engine?</p>',
    ];
    $form['options'] = array(
      '#type' => 'radios',
      '#title' => t('Options'),
      '#options' => array(
        'Yes' => $this->t('Yes'),
        'No' => $this->t('No'),
      ),
    );
    $form['text'] = array(
      '#type' => 'textarea',
      '#title' => t('If yes, share the details'),
    );
    $form['markup2'] = [
      '#markup' => '<p>Are you getting value from your existing solution?</p>',
    ];
    $form['options2'] = array(
      '#type' => 'radios',
      '#title' => t('Options'),
      '#options' => array(
        'Yes' => $this->t('Yes'),
        'No' => $this->t('No'),
        'NA' => $this->t('NA'),
      ),
    );
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep8(array $form) {
    $form['markup'] = [
      '#markup' => '<p>Have you used Multichannel Marketing Hubs like MoEngage,
      Salesforce Marketing Cloud, or Adobe Campaign?</p>',
    ];
    $form['options'] = array(
      '#type' => 'radios',
      '#title' => t('Options'),
      '#options' => array(
        'Yes' => $this->t('Yes'),
        'No' => $this->t('No'),
      ),
    );
    $form['text'] = array(
      '#type' => 'textarea',
      '#title' => t('If yes, share the details'),
    );
    $form['markup2'] = [
      '#markup' => '<p>Are you getting value from your existing solution?</p>',
    ];
    $form['options2'] = array(
      '#type' => 'radios',
      '#title' => t('Options'),
      '#options' => array(
        'Yes' => $this->t('Yes'),
        'No' => $this->t('No'),
        'NA' => $this->t('NA'),
      ),
    );
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep9(array $form) {
    $form['markup'] = [
      '#markup' => '<p>What critical features of CDPs are essential for you?

      Select all that are applicable</p>',
    ];
    $form['cdp_features'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Options'),
      '#options' => array(
        'Data Collecton' => $this->t('Data Collecton'),
        'Profile Unificaion' => $this->t('Profile Unificaion'),
        'Segmentation'=> $this->t('Segmentation'),
        'Personalization & Activation'=> $this->t('Personalization & Activation'),
      ),
    );
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep10(array $form) {
    $form['markup'] = [
      '#markup' => '<p>Based on your responses, it means that your business
      has reached the digital maturity relevant for adopting
      a CDP solution.</p>',
    ];

    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep11(array $form) {
    $form['markup'] = [
      '#markup' => '<p>What\'s your primary goal? Please select</p>',
    ];
    $form['user_data_primary_goal'] = array(
      '#type' => 'radios',
      '#title' => t('Options'),
      '#options' => array(
        '0' => $this->t('To create performance reporting'),
        '1' => $this->t('To collect data only'),
        '2'=> $this->t('I don’t know what my goal is. I need validation'),
      ),
      '#name'=> 'user_data_primary_goal',
    );
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep12(array $form) {
    $form['markup'] = [
      '#markup' => '<p>You can create the custom dashboard
      using BI & Reporting tools like Zoho
      Analytics, Hubspot Marketing Analytics,

      and Mircosoft Power BI.</p>',
    ];

    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep13(array $form) {
    $form['markup'] = [
      '#markup' => '<p>CPDs are typically usefull when you have a

      lot of customer data.</p>',
    ];

    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }


  /**
   * Build the second step of the form.
   */
  private function buildStep14(array $form) {
    $form['markup'] = [
      '#markup' => '<p>Share your goal, and our expert will help
      you identify the solution that fits your
      unique needs.</p>',
    ];

    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep15(array $form) {
    $form['markup'] = [
      '#markup' => '<p>Describe your goal.</p>',
    ];

    $form['text'] = array(
      '#type' => 'textarea',
      '#title' => t('Describe your goal'),
    );

    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep16(array $form) {
    $form['markup'] = [
      '#markup' => '<p>Speak to our experts to learn more.</p>',
    ];
    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep17(array $form) {
    $form['markup'] = [
      '#markup' => '<p>You can use web tracking tools or CRM solutions.</p>',
    ];

    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

  /**
   * Build the second step of the form.
   */
  private function buildStep18(array $form) {
    $form['markup'] = [
      '#markup' => '<p>CPDs are typically usefull when you have a lot of customer data.</p>',
    ];

    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('PREV'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];
    $form['actions'][]['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('NEXT'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'wrapper' => 'custom-multistep-form-wrapper',
      ],
    ];


    return $form;
  }

}
