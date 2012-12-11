<?php

final class PhabricatorTimelineExample extends PhabricatorUIExample {

  public function getName() {
    return 'Timeline View';
  }

  public function getDescription() {
    return 'Use <tt>PhabricatorTimelineView</tt> to comments and transactions.';
  }

  public function renderExample() {
    $request = $this->getRequest();
    $user = $request->getUser();

    $handle = PhabricatorObjectHandleData::loadOneHandle(
      $user->getPHID(),
      $user);

    $events = array();

    $events[] = id(new PhabricatorTimelineEventView())
      ->setUserHandle($handle)
      ->setTitle('A major event.')
      ->appendChild('This is a major timeline event.');

    $events[] = id(new PhabricatorTimelineEventView())
      ->setUserHandle($handle)
      ->setTitle('A minor event.');

    $events[] = id(new PhabricatorTimelineEventView())
      ->setUserHandle($handle)
      ->appendChild('A major event with no title.');

    $events[] = id(new PhabricatorTimelineEventView())
      ->setUserHandle($handle)
      ->setTitle('Another minor event.');

    $events[] = id(new PhabricatorTimelineEventView())
      ->setUserHandle($handle);

    $events[] = id(new PhabricatorTimelineEventView())
      ->setUserHandle($handle)
      ->setTitle('Major Red Event')
      ->setIcon('love')
      ->appendChild('This event is red!')
      ->setColor(PhabricatorTransactions::COLOR_RED);

    $events[] = id(new PhabricatorTimelineEventView())
      ->setUserHandle($handle)
      ->setTitle('Minor Red Event')
      ->setColor(PhabricatorTransactions::COLOR_RED);

    $events[] = id(new PhabricatorTimelineEventView())
      ->setUserHandle($handle)
      ->setTitle('Minor Not-Red Event');

    $events[] = id(new PhabricatorTimelineEventView())
      ->setUserHandle($handle)
      ->setTitle('Minor Red Event')
      ->setColor(PhabricatorTransactions::COLOR_RED);

    $events[] = id(new PhabricatorTimelineEventView())
      ->setUserHandle($handle)
      ->setTitle('Minor Not-Red Event');

    $events[] = id(new PhabricatorTimelineEventView())
      ->setUserHandle($handle)
      ->setTitle('Major Green Event')
      ->appendChild('This event is green!')
      ->setColor(PhabricatorTransactions::COLOR_GREEN);

    $colors = array(
      PhabricatorTransactions::COLOR_RED,
      PhabricatorTransactions::COLOR_ORANGE,
      PhabricatorTransactions::COLOR_YELLOW,
      PhabricatorTransactions::COLOR_GREEN,
      PhabricatorTransactions::COLOR_SKY,
      PhabricatorTransactions::COLOR_BLUE,
      PhabricatorTransactions::COLOR_INDIGO,
      PhabricatorTransactions::COLOR_VIOLET,
      PhabricatorTransactions::COLOR_GREY,
      PhabricatorTransactions::COLOR_BLACK,
    );

    $events[] = id(new PhabricatorTimelineEventView())
      ->setUserHandle($handle)
      ->setTitle(phutil_escape_html("Colorless"))
      ->setIcon('lock');

    foreach ($colors as $color) {
      $events[] = id(new PhabricatorTimelineEventView())
        ->setUserHandle($handle)
        ->setTitle(phutil_escape_html("Color '{$color}'"))
        ->setIcon('lock')
        ->setColor($color);
    }

    $timeline = id(new PhabricatorTimelineView());
    foreach ($events as $event) {
      $timeline->addEvent($event);
    }

    return $timeline;
  }
}
