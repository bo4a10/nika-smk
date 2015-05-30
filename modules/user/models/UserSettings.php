<?php
//
//namespace app\modules\user\models;
//
//use Yii;
//
///**
// * This is the model class for table "user_settings".
// *
// * @property integer $id
// * @property integer $user_id
// * @property integer $flag_mask
// * @property integer $created_at
// * @property integer $updated_at
// *
// * @property User $user
// */
//class UserSettings extends \app\commons\AbstractActiveRecord
//{
//    /**
//     * @inheritdoc
//     */
//    public static function tableName()
//    {
//        return 'user_settings';
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function rules()
//    {
//        return [
//            [['user_id', 'flag_mask', 'created_at', 'updated_at'], 'required'],
//            [['user_id', 'flag_mask', 'created_at', 'updated_at'], 'integer']
//        ];
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => 'ID',
//            'user_id' => 'User ID',
//            'flag_mask' => 'Flag Mask',
//            'created_at' => 'Created At',
//            'updated_at' => 'Updated At',
//        ];
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getUser()
//    {
//        return $this->hasOne(User::className(), ['id' => 'user_id']);
//    }
//
//	/**
//	 * @return int
//	 */
//	public function getId()
//	{
//		return $this->id;
//	}
//
//	/**
//	 * @param int $id
//	 */
//	public function setId($id)
//	{
//		$this->id = $id;
//	}
//
//	/**
//	 * @return int
//	 */
//	public function getUserId()
//	{
//		return $this->user_id;
//	}
//
//	/**
//	 * @param int $user_id
//	 */
//	public function setUserId($user_id)
//	{
//		$this->user_id = $user_id;
//	}
//
//	/**
//	 * @return int
//	 */
//	public function getFlagMask()
//	{
//		return $this->flag_mask;
//	}
//
//	/**
//	 * @param int $flag_mask
//	 */
//	public function setFlagMask($flag_mask)
//	{
//		$this->flag_mask = $flag_mask;
//	}
//
//	/**
//	 * @return int
//	 */
//	public function getCreatedAt()
//	{
//		return $this->created_at;
//	}
//
//	/**
//	 * @param int $created_at
//	 */
//	public function setCreatedAt($created_at)
//	{
//		$this->created_at = $created_at;
//	}
//
//	/**
//	 * @return int
//	 */
//	public function getUpdatedAt()
//	{
//		return $this->updated_at;
//	}
//
//	/**
//	 * @param int $updated_at
//	 */
//	public function setUpdatedAt($updated_at)
//	{
//		$this->updated_at = $updated_at;
//	}
//
//
//}
