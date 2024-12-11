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
        $result = $this->predictV2($data);

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

    function predictV2(array $data)
    {
        // Convert request
        $input = [
            'high_bp' => $data['high_bp'],
            'high_chol' => $data['high_chol'],
            'chol_check' => $data['chol_check'],
            // 'bmi' => $this->calculateBmi($data['weight'], $data['height']),
            'bmi' => $data['bmi'],
            'smoker' => $data['smoker'],
            'stroke' => $data['stroke'],
            'heart_disease' => $data['heart_disease'],
            'phys_activity' => $data['phys_activity'],
            'fruits' => $data['fruits'],
            'veggies' => $data['veggies'],
            'hvy_alcohol' => $data['hvy_alcohol'],
            'any_healthcare' => $data['any_healthcare'],
            'no_doc' => $data['no_doc'],
            'gen_health' => $data['gen_health'],
            'mental_health' => $data['mental_health'],
            'phys_health' => $data['phys_health'],
            'diff_walk' => $data['diff_walk'],
            'sex' => $data['sex'],
            'age' => $data['age'],
        ];

        $input = array_values($input);

        $var0 = array();
        if ($input[0] <= 0.5) {
            if ($input[13] <= 2.5) {
                if ($input[18] <= 8.5) {
                    if ($input[3] <= 27.5) {
                        if ($input[13] <= 1.5) {
                            $var0 = array(0.9790531631388685, 0.02094683686113161);
                        } else {
                            if ($input[1] <= 0.5) {
                                $var0 = array(0.9401375163536841, 0.05986248364631588);
                            } else {
                                $var0 = array(0.849794559581669, 0.150205440418331);
                            }
                        }
                    } else {
                        if ($input[18] <= 5.5) {
                            $var0 = array(0.9156733336921163, 0.08432666630788371);
                        } else {
                            if ($input[1] <= 0.5) {
                                if ($input[3] <= 42.5) {
                                    if ($input[13] <= 1.5) {
                                        $var0 = array(0.9151531650510774, 0.08484683494892271);
                                    } else {
                                        $var0 = array(0.8117270608577998, 0.18827293914220017);
                                    }
                                } else {
                                    $var0 = array(0.5554245700071911, 0.44457542999280886);
                                }
                            } else {
                                if ($input[3] <= 32.5) {
                                    if ($input[13] <= 1.5) {
                                        $var0 = array(0.9124576355496601, 0.08754236445033992);
                                    } else {
                                        $var0 = array(0.715578321236753, 0.28442167876324687);
                                    }
                                } else {
                                    $var0 = array(0.6078281015171881, 0.3921718984828117);
                                }
                            }
                        }
                    }
                } else {
                    if ($input[3] <= 29.5) {
                        if ($input[13] <= 1.5) {
                            if ($input[17] <= 0.5) {
                                $var0 = array(0.9397020920073941, 0.06029790799260584);
                            } else {
                                if ($input[18] <= 9.5) {
                                    $var0 = array(0.9269303708985375, 0.07306962910146246);
                                } else {
                                    $var0 = array(0.7810857776313034, 0.21891422236869665);
                                }
                            }
                        } else {
                            if ($input[3] <= 25.5) {
                                if ($input[17] <= 0.5) {
                                    $var0 = array(0.8597594506266387, 0.14024054937336128);
                                } else {
                                    if ($input[1] <= 0.5) {
                                        if ($input[18] <= 10.5) {
                                            $var0 = array(0.8835070571278848, 0.11649294287211526);
                                        } else {
                                            $var0 = array(0.6970710934400179, 0.302928906559982);
                                        }
                                    } else {
                                        $var0 = array(0.6280167865694656, 0.3719832134305345);
                                    }
                                }
                            } else {
                                if ($input[5] <= 0.5) {
                                    if ($input[18] <= 10.5) {
                                        $var0 = array(0.7510458651391264, 0.24895413486087353);
                                    } else {
                                        $var0 = array(0.6411335619387658, 0.35886643806123425);
                                    }
                                } else {
                                    $var0 = array(0.14808121444510797, 0.8519187855548921);
                                }
                            }
                        }
                    } else {
                        if ($input[13] <= 1.5) {
                            if ($input[16] <= 0.5) {
                                $var0 = array(0.775769805652773, 0.22423019434722702);
                            } else {
                                $var0 = array(0.44431346661637117, 0.5556865333836288);
                            }
                        } else {
                            if ($input[17] <= 0.5) {
                                $var0 = array(0.6312129282790703, 0.36878707172092984);
                            } else {
                                if ($input[3] <= 31.5) {
                                    $var0 = array(0.6311614317799098, 0.36883856822009026);
                                } else {
                                    if ($input[18] <= 11.5) {
                                        $var0 = array(0.43354318868632286, 0.5664568113136771);
                                    } else {
                                        $var0 = array(0.14279219893621858, 0.8572078010637815);
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                if ($input[18] <= 6.5) {
                    if ($input[1] <= 0.5) {
                        if ($input[3] <= 37.5) {
                            if ($input[18] <= 4.5) {
                                if ($input[13] <= 3.5) {
                                    $var0 = array(0.9061695946051281, 0.09383040539487188);
                                } else {
                                    $var0 = array(0.7444246340016388, 0.25557536599836117);
                                }
                            } else {
                                if ($input[3] <= 27.5) {
                                    $var0 = array(0.7990118888559407, 0.20098811114405932);
                                } else {
                                    $var0 = array(0.6457119868078143, 0.3542880131921857);
                                }
                            }
                        } else {
                            if ($input[15] <= 4.5) {
                                $var0 = array(0.6276787277613264, 0.37232127223867373);
                            } else {
                                $var0 = array(0.4595456657201014, 0.5404543342798985);
                            }
                        }
                    } else {
                        if ($input[13] <= 3.5) {
                            if ($input[16] <= 0.5) {
                                if ($input[18] <= 4.5) {
                                    $var0 = array(0.7263096569210892, 0.2736903430789108);
                                } else {
                                    $var0 = array(0.5948442263687036, 0.40515577363129635);
                                }
                            } else {
                                $var0 = array(0.32680635941334774, 0.6731936405866523);
                            }
                        } else {
                            if ($input[3] <= 32.5) {
                                if ($input[15] <= 2.5) {
                                    $var0 = array(0.3141714025914983, 0.6858285974085018);
                                } else {
                                    $var0 = array(0.5746734937856679, 0.4253265062143321);
                                }
                            } else {
                                $var0 = array(0.2343875513025918, 0.7656124486974082);
                            }
                        }
                    }
                } else {
                    if ($input[3] <= 27.5) {
                        if ($input[18] <= 8.5) {
                            if ($input[1] <= 0.5) {
                                if ($input[13] <= 3.5) {
                                    $var0 = array(0.8102228961741307, 0.18977710382586938);
                                } else {
                                    $var0 = array(0.6476062210400803, 0.3523937789599198);
                                }
                            } else {
                                if ($input[13] <= 3.5) {
                                    $var0 = array(0.6517567407545818, 0.34824325924541827);
                                } else {
                                    if ($input[8] <= 0.5) {
                                        $var0 = array(0.5928952209170775, 0.40710477908292253);
                                    } else {
                                        $var0 = array(0.36270922932632604, 0.6372907706736739);
                                    }
                                }
                            }
                        } else {
                            if ($input[3] <= 22.5) {
                                if ($input[6] <= 0.5) {
                                    $var0 = array(0.6879595279559471, 0.31204047204405305);
                                } else {
                                    $var0 = array(0.49449105266640364, 0.5055089473335964);
                                }
                            } else {
                                if ($input[10] <= 0.5) {
                                    if ($input[1] <= 0.5) {
                                        if ($input[2] <= 0.5) {
                                            $var0 = array(0.9199609482776916, 0.08003905172230831);
                                        } else {
                                            if ($input[17] <= 0.5) {
                                                $var0 = array(0.5838711183353348, 0.41612888166466516);
                                            } else {
                                                $var0 = array(0.4641537744535261, 0.5358462255464739);
                                            }
                                        }
                                    } else {
                                        $var0 = array(0.4222006836161299, 0.5777993163838702);
                                    }
                                } else {
                                    $var0 = array(0.8366622127609811, 0.1633377872390189);
                                }
                            }
                        }
                    } else {
                        if ($input[13] <= 3.5) {
                            if ($input[18] <= 8.5) {
                                if ($input[3] <= 33.5) {
                                    if ($input[1] <= 0.5) {
                                        if ($input[18] <= 7.5) {
                                            $var0 = array(0.725246420541285, 0.274753579458715);
                                        } else {
                                            $var0 = array(0.5540858040583214, 0.44591419594167875);
                                        }
                                    } else {
                                        $var0 = array(0.5049178992671916, 0.4950821007328085);
                                    }
                                } else {
                                    $var0 = array(0.4347726805855202, 0.5652273194144797);
                                }
                            } else {
                                if ($input[6] <= 0.5) {
                                    if ($input[3] <= 32.5) {
                                        $var0 = array(0.44519176389911175, 0.5548082361008883);
                                    } else {
                                        if ($input[17] <= 0.5) {
                                            $var0 = array(0.39203042052886566, 0.6079695794711343);
                                        } else {
                                            $var0 = array(0.25452896193005226, 0.7454710380699479);
                                        }
                                    }
                                } else {
                                    $var0 = array(0.2286059911834761, 0.771394008816524);
                                }
                            }
                        } else {
                            if ($input[18] <= 9.5) {
                                if ($input[3] <= 35.5) {
                                    if ($input[1] <= 0.5) {
                                        if ($input[14] <= 0.5) {
                                            $var0 = array(0.35321213492840886, 0.6467878650715913);
                                        } else {
                                            $var0 = array(0.5635058884805695, 0.4364941115194304);
                                        }
                                    } else {
                                        $var0 = array(0.28781694829082943, 0.7121830517091706);
                                    }
                                } else {
                                    $var0 = array(0.2161263317239882, 0.7838736682760118);
                                }
                            } else {
                                $var0 = array(0.21021234439300246, 0.7897876556069975);
                            }
                        }
                    }
                }
            }
        } else {
            if ($input[13] <= 2.5) {
                if ($input[3] <= 29.5) {
                    if ($input[18] <= 9.5) {
                        if ($input[1] <= 0.5) {
                            if ($input[18] <= 6.5) {
                                $var0 = array(0.9099911617084229, 0.09000883829157717);
                            } else {
                                if ($input[10] <= 0.5) {
                                    $var0 = array(0.7435270401062953, 0.2564729598937047);
                                } else {
                                    $var0 = array(0.9677253712540823, 0.03227462874591777);
                                }
                            }
                        } else {
                            if ($input[18] <= 3.5) {
                                $var0 = array(0.9374689102160202, 0.06253108978397992);
                            } else {
                                if ($input[3] <= 25.5) {
                                    $var0 = array(0.6828822525915565, 0.31711774740844345);
                                } else {
                                    $var0 = array(0.5705770989813964, 0.42942290101860364);
                                }
                            }
                        }
                    } else {
                        if ($input[3] <= 23.5) {
                            if ($input[16] <= 0.5) {
                                if ($input[9] <= 0.5) {
                                    $var0 = array(0.5486491277328299, 0.45135087226717013);
                                } else {
                                    $var0 = array(0.7288108291577264, 0.27118917084227356);
                                }
                            } else {
                                $var0 = array(0.4842425116496501, 0.51575748835035);
                            }
                        } else {
                            if ($input[16] <= 0.5) {
                                if ($input[13] <= 1.5) {
                                    $var0 = array(0.6254681572606109, 0.37453184273938905);
                                } else {
                                    if ($input[17] <= 0.5) {
                                        $var0 = array(0.5304546417256423, 0.46954535827435767);
                                    } else {
                                        $var0 = array(0.4440408174423097, 0.5559591825576904);
                                    }
                                }
                            } else {
                                if ($input[6] <= 0.5) {
                                    $var0 = array(0.4029335970420455, 0.5970664029579544);
                                } else {
                                    $var0 = array(0.11759200329452296, 0.8824079967054771);
                                }
                            }
                        }
                    }
                } else {
                    if ($input[18] <= 8.5) {
                        if ($input[1] <= 0.5) {
                            if ($input[18] <= 7.5) {
                                if ($input[3] <= 32.5) {
                                    $var0 = array(0.8657101529989812, 0.13428984700101887);
                                } else {
                                    $var0 = array(0.6304734349779618, 0.3695265650220381);
                                }
                            } else {
                                $var0 = array(0.523677203902331, 0.476322796097669);
                            }
                        } else {
                            if ($input[3] <= 36.5) {
                                if ($input[15] <= 0.5) {
                                    $var0 = array(0.556831123622064, 0.443168876377936);
                                } else {
                                    $var0 = array(0.38697092482067563, 0.6130290751793243);
                                }
                            } else {
                                $var0 = array(0.2745057408212542, 0.7254942591787458);
                            }
                        }
                    } else {
                        if ($input[1] <= 0.5) {
                            if ($input[18] <= 9.5) {
                                $var0 = array(0.5238851526029326, 0.47611484739706744);
                            } else {
                                $var0 = array(0.3872756889508887, 0.6127243110491113);
                            }
                        } else {
                            if ($input[16] <= 0.5) {
                                if ($input[10] <= 0.5) {
                                    $var0 = array(0.3259338633442021, 0.6740661366557981);
                                } else {
                                    $var0 = array(0.5598692865933879, 0.4401307134066122);
                                }
                            } else {
                                $var0 = array(0.19923967699173611, 0.8007603230082638);
                            }
                        }
                    }
                }
            } else {
                if ($input[3] <= 26.5) {
                    if ($input[1] <= 0.5) {
                        if ($input[18] <= 6.5) {
                            if ($input[13] <= 4.5) {
                                $var0 = array(0.7783895194723476, 0.2216104805276525);
                            } else {
                                $var0 = array(0.43986929491395954, 0.5601307050860405);
                            }
                        } else {
                            if ($input[6] <= 0.5) {
                                if ($input[13] <= 3.5) {
                                    if ($input[10] <= 0.5) {
                                        $var0 = array(0.537502538349036, 0.4624974616509639);
                                    } else {
                                        $var0 = array(0.8570778886092835, 0.14292211139071648);
                                    }
                                } else {
                                    if ($input[3] <= 20.5) {
                                        $var0 = array(0.6665487727240573, 0.3334512272759427);
                                    } else {
                                        $var0 = array(0.39605448990784264, 0.6039455100921574);
                                    }
                                }
                            } else {
                                if ($input[3] <= 19.5) {
                                    $var0 = array(0.6998885882540189, 0.3001114117459812);
                                } else {
                                    $var0 = array(0.32269106502092015, 0.6773089349790798);
                                }
                            }
                        }
                    } else {
                        if ($input[13] <= 3.5) {
                            if ($input[18] <= 5.5) {
                                $var0 = array(0.7198930435889818, 0.28010695641101835);
                            } else {
                                if ($input[10] <= 0.5) {
                                    if ($input[3] <= 19.5) {
                                        $var0 = array(0.6077166805707829, 0.39228331942921707);
                                    } else {
                                        $var0 = array(0.375984746472748, 0.624015253527252);
                                    }
                                } else {
                                    $var0 = array(0.6620434826870768, 0.33795651731292325);
                                }
                            }
                        } else {
                            if ($input[3] <= 23.5) {
                                $var0 = array(0.36230346559055765, 0.6376965344094423);
                            } else {
                                $var0 = array(0.24018234009467054, 0.7598176599053293);
                            }
                        }
                    }
                } else {
                    if ($input[13] <= 3.5) {
                        if ($input[18] <= 5.5) {
                            if ($input[18] <= 3.5) {
                                $var0 = array(0.7025918682213674, 0.29740813177863246);
                            } else {
                                if ($input[3] <= 36.5) {
                                    if ($input[14] <= 1.5) {
                                        $var0 = array(0.46843933579470026, 0.5315606642052996);
                                    } else {
                                        $var0 = array(0.6544254957944287, 0.3455745042055713);
                                    }
                                } else {
                                    $var0 = array(0.32585030943520926, 0.6741496905647907);
                                }
                            }
                        } else {
                            if ($input[1] <= 0.5) {
                                if ($input[18] <= 8.5) {
                                    if ($input[3] <= 36.5) {
                                        if ($input[10] <= 0.5) {
                                            $var0 = array(0.4754058606542148, 0.5245941393457851);
                                        } else {
                                            $var0 = array(0.8399286911861458, 0.1600713088138543);
                                        }
                                    } else {
                                        $var0 = array(0.2918903436467679, 0.708109656353232);
                                    }
                                } else {
                                    if ($input[3] <= 32.5) {
                                        $var0 = array(0.3423333882113086, 0.6576666117886915);
                                    } else {
                                        $var0 = array(0.24725107898944765, 0.7527489210105524);
                                    }
                                }
                            } else {
                                if ($input[3] <= 32.5) {
                                    if ($input[10] <= 0.5) {
                                        if ($input[18] <= 8.5) {
                                            $var0 = array(0.3321455591543712, 0.6678544408456288);
                                        } else {
                                            $var0 = array(0.24340606651084967, 0.7565939334891503);
                                        }
                                    } else {
                                        $var0 = array(0.5453230193483672, 0.45467698065163276);
                                    }
                                } else {
                                    $var0 = array(0.17850685759441295, 0.8214931424055871);
                                }
                            }
                        }
                    } else {
                        if ($input[1] <= 0.5) {
                            if ($input[18] <= 6.5) {
                                $var0 = array(0.37452361207611584, 0.625476387923884);
                            } else {
                                if ($input[3] <= 30.5) {
                                    if ($input[10] <= 0.5) {
                                        $var0 = array(0.2715992216764032, 0.7284007783235968);
                                    } else {
                                        $var0 = array(0.8499323517707918, 0.15006764822920807);
                                    }
                                } else {
                                    $var0 = array(0.17562817209679957, 0.8243718279032004);
                                }
                            }
                        } else {
                            if ($input[3] <= 32.5) {
                                $var0 = array(0.18884058793675934, 0.8111594120632407);
                            } else {
                                if ($input[10] <= 0.5) {
                                    if ($input[2] <= 0.5) {
                                        $var0 = array(0.4136644326728906, 0.5863355673271093);
                                    } else {
                                        $var0 = array(0.1056409265776613, 0.8943590734223388);
                                    }
                                } else {
                                    $var0 = array(0.33321546023551063, 0.6667845397644894);
                                }
                            }
                        }
                    }
                }
            }
        }

        // Angka yang dibelakang itu hasilnya
        return $var0[1] >= 0.5 ? 1 : 0;
    }
}
