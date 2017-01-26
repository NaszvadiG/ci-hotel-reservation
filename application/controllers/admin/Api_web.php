<?php

defined('BASEPATH') or exit('invalid');

class Api_web extends Admin_Controller
{

        function __construct()
        {
                parent::__construct();
        }

        public function users()
        {
                $data = array();

                foreach ($this->ion_auth->users()->result() as $user)
                {
                        $type = '';
                        foreach ($this->ion_auth->get_users_groups($user->id)->result() as $group)
                        {
                                $type .= anchor('admin/users/#', $group->name) . ' | ';
                        }
                        $type   = rtrim($type, " | ");
                        $data[] = array(
                            'first_name' => $user->first_name,
                            'last_name'  => $user->last_name,
                            'username'   => $user->username,
                            'email'      => $user->email,
                            'created_on' => $user->created_on,
                            'active'     => $this->to_readable_active($user->active),
                            'company'    => $user->company,
                            'phone'      => $user->phone,
                            'user_type'  => $type
                        );
                }
                $this->_render_json_view($data);
        }

        public function Rooms()
        {
                $this->load->helper('html');
                $data = array();
                $this->load->model('Room_model');

                $obj = $this->Room_model->with_users()->with_room_type()->as_object()->get_all();


                foreach ($obj as $v)
                {
                        $image_properties = array(
                            'src'   => base_url($this->config->item('room_image_dir') . $v->room_image),
                            'alt'   => 'room number ' . $v->room_number,
                            'width' => '80',
                            'title' => 'room number ' . $v->room_number,
                        );
                        $data[]           = array(
                            'room_image'         => img($image_properties),
                            'room_price'         => $this->config->item('currency') . $v->room_price,
                            'room_description'   => $v->room_description,
                            'room_number'        => $v->room_number,
                            'room_bed_count'     => $v->room_bed_count,
                            'room_type'          => $v->room_type->room_type_name,
                            'room_has_breakfast' => anchor(base_url('admin/rooms/change-breakfast/' . $v->room_id), $this->to_readable_active($v->room_has_breakfast)),
                            'room_has_aircon'    => anchor(base_url('admin/rooms/change-aircon/' . $v->room_id), $this->to_readable_active($v->room_has_aircon)),
                            'room_has_gym'       => anchor(base_url('admin/rooms/change-gym/' . $v->room_id), $this->to_readable_active($v->room_has_gym)),
                            'room_has_tvlcd'     => anchor(base_url('admin/rooms/change-tvlcd/' . $v->room_id), $this->to_readable_active($v->room_has_tvlcd)),
                            'room_has_wifi'      => anchor(base_url('admin/rooms/change-wifi/' . $v->room_id), $this->to_readable_active($v->room_has_wifi)),
                            'room_best'          => anchor(base_url('admin/rooms/change-best/' . $v->room_id), $this->to_readable_active($v->room_best)),
                            'room_active'        => anchor(base_url('admin/rooms/change-status/' . $v->room_id), $this->to_readable_active($v->room_active)),
                            'user'               => $v->users->last_name . ', ' . $v->users->first_name
                        );
                }
                $this->_render_json_view($data);
        }

        public function room_types()
        {
                $data = array();

                $this->load->model('Room_type_model');
                $obj = $this->Room_type_model->with_users()->as_object()->get_all();

                foreach ($obj as $v)
                {
                        $data[] = array(
                            'name'        => $v->room_type_name,
                            'description' => $v->room_type_description,
                            'active'      => anchor(base_url('admin/room-types/change-status/' . $v->room_type_id), $this->to_readable_active($v->room_type_active)),
                            'user'        => $v->users->last_name . ', ' . $v->users->first_name
                        );
                }
                $this->_render_json_view($data);
        }

        private function to_readable_active($bool)
        {
                if ($bool)
                {
                        return 'Enabled';
                }
                else
                {
                        return 'Disabled';
                }
        }

}
