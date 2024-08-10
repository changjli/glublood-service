<?php

namespace App\Services;

use App\Models\DiabetesPrediction;
use App\Repositories\DiabetesPredictionRepositoryInterface;
use Illuminate\Support\Facades\Log;

class DiabetesPredictionService implements DiabetesPredictionServiceInterface
{
    public function getByUserId($user_id)
    {
        return DiabetesPrediction::where('user_id', $user_id)->get();
    }

    public function getById($id)
    {
        return DiabetesPrediction::where('id', $id)->first();
    }

    public function create(array $data)
    {
        $result = $this->predict($data);

        $data['result'] = $result;

        Log::info($data);

        DiabetesPrediction::create($data);

        return $result;
    }

    public function calculateBmi($weight, $height)
    {
        $result = $weight / pow($height / 100, 2);
        return round($result, 2);
    }

    public function calculateDiabetesPedigree($mother, $father, $sister, $brother)
    {
        $parent = 0.5;
        $sibling = 0.25;
        $result = $parent * $mother + $parent * $father + $sibling * $sister + $sibling * $brother;
        return round($result, 2);
    }

    function predict(array $data)
    {
        // Convert request
        $input = [
            'pregnancies' => $data['pregnancies'],
            'glucose' => $data['glucose'],
            'blood_pressure' => $data['blood_pressure'],
            'skin_thickness' => $data['skin_thickness'],
            'insulin' => $data['insulin'],
            'bmi' => $this->calculateBmi($data['weight'], $data['height']),
            'diabetes_pedigree' => $this->calculateDiabetesPedigree($data['is_father'], $data['is_mother'], $data['is_sister'], $data['is_brother']),
            'age' => $data['age'],
        ];

        $input = array_values($input);

        $var0 = array();
        if ($input[1] <= 113.5) {
            if ($input[5] <= 26.899999618530273) {
                $var0 = array(1.0, 0.0);
            } else {
                if ($input[7] <= 35.5) {
                    if ($input[5] <= 33.25) {
                        if ($input[3] <= 5.0) {
                            if ($input[1] <= 109.0) {
                                $var0 = array(0.0, 1.0);
                            } else {
                                $var0 = array(1.0, 0.0);
                            }
                        } else {
                            if ($input[0] <= 7.0) {
                                if ($input[3] <= 29.5) {
                                    $var0 = array(1.0, 0.0);
                                } else {
                                    if ($input[6] <= 0.3020000010728836) {
                                        if ($input[7] <= 24.0) {
                                            $var0 = array(1.0, 0.0);
                                        } else {
                                            $var0 = array(0.0, 1.0);
                                        }
                                    } else {
                                        $var0 = array(1.0, 0.0);
                                    }
                                }
                            } else {
                                $var0 = array(0.0, 1.0);
                            }
                        }
                    } else {
                        if ($input[6] <= 0.4685000032186508) {
                            if ($input[2] <= 83.5) {
                                if ($input[5] <= 33.44999885559082) {
                                    $var0 = array(0.0, 1.0);
                                } else {
                                    if ($input[0] <= 6.5) {
                                        $var0 = array(1.0, 0.0);
                                    } else {
                                        $var0 = array(0.0, 1.0);
                                    }
                                }
                            } else {
                                if ($input[2] <= 87.0) {
                                    $var0 = array(0.0, 1.0);
                                } else {
                                    $var0 = array(1.0, 0.0);
                                }
                            }
                        } else {
                            if ($input[5] <= 38.80000114440918) {
                                if ($input[1] <= 79.0) {
                                    $var0 = array(1.0, 0.0);
                                } else {
                                    $var0 = array(0.0, 1.0);
                                }
                            } else {
                                $var0 = array(1.0, 0.0);
                            }
                        }
                    }
                } else {
                    if ($input[1] <= 99.5) {
                        if ($input[2] <= 70.0) {
                            $var0 = array(0.0, 1.0);
                        } else {
                            if ($input[1] <= 28.5) {
                                $var0 = array(0.0, 1.0);
                            } else {
                                $var0 = array(1.0, 0.0);
                            }
                        }
                    } else {
                        if ($input[7] <= 51.0) {
                            if ($input[3] <= 47.0) {
                                if ($input[6] <= 0.1315000019967556) {
                                    $var0 = array(1.0, 0.0);
                                } else {
                                    if ($input[2] <= 59.0) {
                                        $var0 = array(1.0, 0.0);
                                    } else {
                                        if ($input[0] <= 7.5) {
                                            if ($input[3] <= 35.5) {
                                                if ($input[7] <= 39.5) {
                                                    if ($input[5] <= 35.14999961853027) {
                                                        $var0 = array(0.0, 1.0);
                                                    } else {
                                                        $var0 = array(1.0, 0.0);
                                                    }
                                                } else {
                                                    $var0 = array(0.0, 1.0);
                                                }
                                            } else {
                                                $var0 = array(1.0, 0.0);
                                            }
                                        } else {
                                            $var0 = array(0.0, 1.0);
                                        }
                                    }
                                }
                            } else {
                                $var0 = array(1.0, 0.0);
                            }
                        } else {
                            if ($input[0] <= 4.5) {
                                if ($input[2] <= 88.0) {
                                    $var0 = array(0.0, 1.0);
                                } else {
                                    $var0 = array(1.0, 0.0);
                                }
                            } else {
                                $var0 = array(1.0, 0.0);
                            }
                        }
                    }
                }
            }
        } else {
            if ($input[5] <= 23.199999809265137) {
                if ($input[5] <= 10.5) {
                    $var0 = array(0.0, 1.0);
                } else {
                    $var0 = array(1.0, 0.0);
                }
            } else {
                if ($input[1] <= 154.5) {
                    if ($input[5] <= 26.25) {
                        if ($input[7] <= 58.5) {
                            $var0 = array(1.0, 0.0);
                        } else {
                            $var0 = array(0.0, 1.0);
                        }
                    } else {
                        if ($input[6] <= 0.10950000211596489) {
                            $var0 = array(1.0, 0.0);
                        } else {
                            if ($input[6] <= 1.3794999718666077) {
                                if ($input[7] <= 29.5) {
                                    if ($input[4] <= 41.5) {
                                        if ($input[7] <= 23.5) {
                                            if ($input[1] <= 145.0) {
                                                $var0 = array(0.0, 1.0);
                                            } else {
                                                if ($input[0] <= 1.5) {
                                                    $var0 = array(0.0, 1.0);
                                                } else {
                                                    $var0 = array(1.0, 0.0);
                                                }
                                            }
                                        } else {
                                            if ($input[6] <= 0.37150000035762787) {
                                                if ($input[0] <= 9.5) {
                                                    if ($input[2] <= 81.0) {
                                                        $var0 = array(0.0, 1.0);
                                                    } else {
                                                        if ($input[5] <= 44.69999885559082) {
                                                            $var0 = array(1.0, 0.0);
                                                        } else {
                                                            $var0 = array(0.0, 1.0);
                                                        }
                                                    }
                                                } else {
                                                    $var0 = array(1.0, 0.0);
                                                }
                                            } else {
                                                if ($input[0] <= 2.5) {
                                                    $var0 = array(1.0, 0.0);
                                                } else {
                                                    if ($input[6] <= 0.4650000035762787) {
                                                        $var0 = array(1.0, 0.0);
                                                    } else {
                                                        $var0 = array(0.0, 1.0);
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        if ($input[7] <= 23.5) {
                                            $var0 = array(1.0, 0.0);
                                        } else {
                                            if ($input[2] <= 73.0) {
                                                if ($input[0] <= 4.5) {
                                                    if ($input[1] <= 120.0) {
                                                        $var0 = array(1.0, 0.0);
                                                    } else {
                                                        $var0 = array(0.0, 1.0);
                                                    }
                                                } else {
                                                    $var0 = array(1.0, 0.0);
                                                }
                                            } else {
                                                if ($input[5] <= 44.89999961853027) {
                                                    if ($input[0] <= 4.5) {
                                                        $var0 = array(1.0, 0.0);
                                                    } else {
                                                        $var0 = array(0.0, 1.0);
                                                    }
                                                } else {
                                                    $var0 = array(0.0, 1.0);
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    if ($input[7] <= 59.5) {
                                        if ($input[6] <= 0.5275000035762787) {
                                            if ($input[0] <= 3.5) {
                                                if ($input[7] <= 30.5) {
                                                    $var0 = array(1.0, 0.0);
                                                } else {
                                                    $var0 = array(0.0, 1.0);
                                                }
                                            } else {
                                                if ($input[2] <= 85.0) {
                                                    if ($input[5] <= 27.949999809265137) {
                                                        $var0 = array(1.0, 0.0);
                                                    } else {
                                                        if ($input[7] <= 41.5) {
                                                            if ($input[4] <= 47.0) {
                                                                if ($input[2] <= 75.0) {
                                                                    if ($input[0] <= 9.0) {
                                                                        $var0 = array(0.0, 1.0);
                                                                    } else {
                                                                        if ($input[1] <= 125.5) {
                                                                            $var0 = array(1.0, 0.0);
                                                                        } else {
                                                                            $var0 = array(0.0, 1.0);
                                                                        }
                                                                    }
                                                                } else {
                                                                    $var0 = array(1.0, 0.0);
                                                                }
                                                            } else {
                                                                if ($input[5] <= 39.400001525878906) {
                                                                    if ($input[7] <= 40.5) {
                                                                        $var0 = array(1.0, 0.0);
                                                                    } else {
                                                                        $var0 = array(0.0, 1.0);
                                                                    }
                                                                } else {
                                                                    $var0 = array(0.0, 1.0);
                                                                }
                                                            }
                                                        } else {
                                                            if ($input[5] <= 42.20000076293945) {
                                                                $var0 = array(0.0, 1.0);
                                                            } else {
                                                                if ($input[6] <= 0.21400000154972076) {
                                                                    $var0 = array(1.0, 0.0);
                                                                } else {
                                                                    $var0 = array(0.0, 1.0);
                                                                }
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    if ($input[6] <= 0.19500000029802322) {
                                                        $var0 = array(0.0, 1.0);
                                                    } else {
                                                        $var0 = array(1.0, 0.0);
                                                    }
                                                }
                                            }
                                        } else {
                                            if ($input[2] <= 69.0) {
                                                if ($input[7] <= 38.0) {
                                                    if ($input[2] <= 66.0) {
                                                        $var0 = array(0.0, 1.0);
                                                    } else {
                                                        if ($input[7] <= 32.0) {
                                                            $var0 = array(0.0, 1.0);
                                                        } else {
                                                            $var0 = array(1.0, 0.0);
                                                        }
                                                    }
                                                } else {
                                                    if ($input[6] <= 0.6435000002384186) {
                                                        $var0 = array(0.0, 1.0);
                                                    } else {
                                                        $var0 = array(1.0, 0.0);
                                                    }
                                                }
                                            } else {
                                                if ($input[5] <= 39.70000076293945) {
                                                    $var0 = array(0.0, 1.0);
                                                } else {
                                                    if ($input[4] <= 75.0) {
                                                        $var0 = array(1.0, 0.0);
                                                    } else {
                                                        $var0 = array(0.0, 1.0);
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        if ($input[0] <= 4.5) {
                                            if ($input[7] <= 65.0) {
                                                $var0 = array(1.0, 0.0);
                                            } else {
                                                $var0 = array(0.0, 1.0);
                                            }
                                        } else {
                                            $var0 = array(1.0, 0.0);
                                        }
                                    }
                                }
                            } else {
                                $var0 = array(1.0, 0.0);
                            }
                        }
                    }
                } else {
                    if ($input[4] <= 629.5) {
                        if ($input[6] <= 0.3004999905824661) {
                            if ($input[6] <= 0.2880000025033951) {
                                if ($input[7] <= 59.5) {
                                    if ($input[0] <= 0.5) {
                                        $var0 = array(1.0, 0.0);
                                    } else {
                                        if ($input[7] <= 37.5) {
                                            if ($input[6] <= 0.21900000423192978) {
                                                $var0 = array(1.0, 0.0);
                                            } else {
                                                if ($input[6] <= 0.2695000022649765) {
                                                    $var0 = array(0.0, 1.0);
                                                } else {
                                                    $var0 = array(1.0, 0.0);
                                                }
                                            }
                                        } else {
                                            $var0 = array(0.0, 1.0);
                                        }
                                    }
                                } else {
                                    $var0 = array(1.0, 0.0);
                                }
                            } else {
                                $var0 = array(1.0, 0.0);
                            }
                        } else {
                            if ($input[2] <= 52.0) {
                                if ($input[1] <= 186.0) {
                                    $var0 = array(0.0, 1.0);
                                } else {
                                    $var0 = array(1.0, 0.0);
                                }
                            } else {
                                if ($input[4] <= 520.0) {
                                    $var0 = array(0.0, 1.0);
                                } else {
                                    if ($input[3] <= 46.5) {
                                        $var0 = array(1.0, 0.0);
                                    } else {
                                        $var0 = array(0.0, 1.0);
                                    }
                                }
                            }
                        }
                    } else {
                        $var0 = array(1.0, 0.0);
                    }
                }
            }
        }

        // Angka yang dibelakang itu hasilnya
        return $var0[1];
    }
}
