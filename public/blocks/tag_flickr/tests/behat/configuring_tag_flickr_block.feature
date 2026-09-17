@block @block_tag_flickr
Feature: Adding and configuring Flickr block
  In order to have the Flickr block used
  As a admin
  I need to add the Flickr block to the tags site page

  Background:
    # We need to create a user to use tag here because the tags site page only shows the tag that currently being used.
    Given the following "users" exist:
      | username | interests |
      | student1 | Cats      |
    And I log in as "admin"
    And I navigate to "Plugins > Blocks > Manage blocks" in site administration
    And I toggle the "Enable Flickr" admin switch "on"
    And I turn editing mode on
    And the following "blocks" exist:
      | blockname  | contextlevel | reference | pagetypepattern | defaultregion |
      | tag_flickr | System       | 1         | tag-search      | side-post     |
      | tag_flickr | System       | 1         | tag-index       | side-post     |

  @javascript
  Scenario: Block displays error notification if Flickr API key is not set.
    Given the following config values are set as admin:
     | apikey |  | block_tag_flickr |
    When I visit "/tag/search.php"
    Then "block_tag_flickr" "block" should exist
    And I should see "The Flickr API key is not set. Contact your administrator."

  @javascript
  Scenario: Block displays error notification if Flickr API responds with an error.
    Given the following config values are set as admin:
      | apikey | bogusapikey | block_tag_flickr |
    When I visit "/tag/search.php"
    And I click on "Cats" "link"
    Then "block_tag_flickr" "block" should exist
    And I should see "Something went wrong while retrieving data from Flickr. Contact your administrator."

  @javascript
  Scenario: Adding Flickr block to the tags site page
    Given the following config values are set as admin:
      | apikey | loremipsum | block_tag_flickr |
    When I visit "/tag/search.php"
    Then "block_tag_flickr" "block" should exist
    And I configure the "Flickr" block
    Then I should see "Flickr block title"
    And I set the field "Flickr block title" to "The Flickr block header"
    And I press "Save changes"
    Then "block_tag_flickr" "block" should exist
    And "The Flickr block header" "block" should exist

  @javascript
  Scenario: Adding Flickr block to a specific tag page
    Given the following config values are set as admin:
      | apikey | loremipsum | block_tag_flickr |
    When I visit "/tag/search.php"
    And I click on "Cats" "link"
    Then "block_tag_flickr" "block" should exist
