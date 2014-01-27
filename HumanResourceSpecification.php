<?php
class HumanResource{
	public $currentDate;
	function __construct(DateTime $currentDate){
		$this->currentDate = $currentDate;
	}
	
	function salaryIsPaid(){
		$day = $this->currentDate->format('j');
		if(25 === $day) {
			return "You are rich man";
		}else if(24 === $day){
			return "Tomorrow dude";
		}else {
			$weekDay = $this->currentDate->format('j-w');
			if("23-5" === $weekDay){
				return "22 days left";
			}else if("24-5" === $weekDay){
				return "23 days left";
			}
		}
 	}
}

class HumanResourceSpecification extends PHPUnit_Framework_TestCase {
	function testTodayIsPayDay(){
		$expected = "You are rich man";
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->once())
		                 ->method('format')
										 ->with($this->equalTo('j'))
										 ->will($this->returnValue(25));
		$humanResource = new HumanResource($mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
	
	function testTomorrowIsPayDay(){
		$expected = "Tomorrow dude";
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->once())
		                 ->method('format')
										 ->with($this->equalTo('j'))
										 ->will($this->returnValue(24));
		$humanResource = new HumanResource($mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
	
	function test23isFriday(){
		$expected = "22 days left";
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->any())
		                 ->method('format')									 
										 ->will($this->returnValue("23-5"));
		$humanResource = new HumanResource($mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
	
	function test24isFriday(){
		$expected = "23 days left";
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->any())
		                 ->method('format')									 
										 ->will($this->returnValue("24-5"));
		$humanResource = new HumanResource($mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
}