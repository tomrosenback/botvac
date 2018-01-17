# NeatoBotvac

This is an unofficial API client which can help you
to interact with the Neato cloudservices which are
used to control you Neato Connected vacuum robot.

Thanks to [Lars Brillert @kangguru](https://github.com/kangguru) who reverse engineered the Neato API from which this library is ported from. Port is based on https://github.com/kangguru/botvac

## Disclaimer

As this is an unofficial client to the Neato API which required
to be reverse engineered (by Lars Brillert) things are topic to be unstable and maybe unreliable.

Please don't blame me :) Just drink a beer and relax, things
will maybe work out in the future ... and maybe not.

## Usage
Check the examples to get a hint on how to use the library, most is self explanatory.

Currently the following methods are available in the NeatoBotvacRobot class (some of them takes parameter(s) but have safe defaults):

* getRobotState
* startCleaning (2-Home / 3-Spot)
* pauseCleaning
* stopCleaning
* sendToBase
* enableSchedule
* disableSchedule
* getSchedule
* setSchedule

The method names should give you an idea what the specific action will
cause. Still this is not all, but that's what is available for the moment.

## Contributing

1. Fork it ( http://github.com/tomrosenback/botvac/fork )
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request
