Feature:
    People can join as members to start using the platform. In order to join the platform, the members will need to provide personal information for identification purposes.

Scenario: A member can sign up
    When the visitor provides personal details
    Then the visitor signs up

Scenario: A member cannot sign up with an existing email address
    Given a member already exists in the platform
    When the visitor provides personal details including an existing member email address
    Then the visitor is not able to join the platform

