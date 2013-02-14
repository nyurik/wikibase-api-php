<?php

/**
 * A snak.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 *
 * @licence GNU GPL v2+
 * @author Thomas Pellissier Tanon
 *
 * @todo datavalue managment
 */
class Snak {

	/**
	 * @var string
	 */
	protected $type;

	/**
	 * @var string
	 */
	protected $propertyId;

	/**
	 * @var mixed
	 */
	protected $dataValue;

	/**
	 * string $type type of snak
	 * @param string $propertyId id of the property
	 * @param mixed|null $dataValue value of the property (optional)
	 */
	public function __construct( $type, $propertyId, $dataValue = null ) {
		$this->type = $type;
		$this->propertyId = $propertyId;
		$this->dataValue = $dataValue;
	}

	/**
	 * @param array $data
	 * @return Snak
	 * @throws Exception
	 */
	public function newFromArray( array $data ) {
		if( !isset( $data['snaktype'] ) || !isset( $data['property'] ) ) {
			throw new Exeption( 'Invalid Snak serialization' );
		}
		$dataValue = isset( $data['datavalue'] ) ? $data['datavalue'] : null;
		return new self( $data['snaktype'], $data['property'], $dataValue );
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getPropertyId() {
		return $this->propertyId;
	}

	/**
	 * @return string
	 */
	public function getDataValue() {
		return $this->dataValue;
	}

	/**
	 * @param string $type
	 */
	public function setType( $type ) {
		$this->type = $type;
	}

	/**
	 * @param string $value
	 */
	public function setDataValue( $value ) {
		$this->dataValue = $value;
	}

	/**
	 * @return array
	 */
	public function toArray() {
		$array = array(
			'snaktype' => $this->type,
			'property' => $this->propertyId
		);
		if( $this->dataValue !== null ) {
			$array['datavalue'] = $this->dataValue;
		}
		return $array;
	}
}
