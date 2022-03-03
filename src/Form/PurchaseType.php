<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Crypto;
use App\Entity\Purchase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\ChoiceList\ChoiceList;

class PurchaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
        ->add('currency', ChoiceType::class,[
            'label' => false,
            'choices'  => [
                'Bitcoin' => 'Bitcoin',
                'Ethereum' => 'Ethereum',
                'Tether' => 'Tether',
                'BNB' => 'BNB',
                'USD Coin' => 'USD Coin',
                'XRP' => 'XRP',
                'Terra' => 'Terra',
                'Solana' => 'Solana',
                'Cardano' => 'Cardano',
                'Binance USD' => 'Binance USD',
                'Dogecoin' => 'Dogecoin',
                'Shiba Inu' => 'Shiba Inu',
                'Polygon' => 'Polygon',
                'Wrapped Bitcoin' => 'Wrapped Bitcoin',
                'Cronos' => 'Cronos',
                'Dai' => 'Dai',
                'Cosmos' => 'Cosmos',
                'Litecoin' => 'Litecoin',
                'NEAR Protocol' => 'NEAR Protocol',
                'Chainlink' => 'Chainlink',
                'FTX Token' => 'FTX Token',
                'TRON' => 'TRON',
                'Bitcoin Cash' => 'Bitcoin Cash',
                'Algorand' => 'Algorand',
                'UNUS SED LEO' => 'UNUS SED LEO',
                'Decentraland' => 'Decentraland',
                'Fantom' => 'Fantom',
                'Stellar' => 'Stellar',
                'Bitcoin BEP2' => 'Bitcoin BEP2',
                'Hedera' => 'Hedera',
                'Internet Computer' => 'Internet Computer',
                'Ethereum Classic' => 'Ethereum Classic',
                'The Sandbox' => 'The Sandbox',
                'VeChain' => 'VeChain',
                'Filecoin' => 'Filecoin',
                'Axie Infinity' => 'Axie Infinity',
                'Elrond' => 'Elrond',
                'Theta Network' => 'Theta Network',
                'Monero' => 'Monero',
                'Klaytn' => 'Klaytn',
                'Tezos' => 'Tezos',
                'Helium' => 'Helium',
                'Helium' => 'Helium',
                'EOS' => 'EOS',
                'Flow' => 'Flow',
                'Waves' => 'Waves',
                'THORChain' => 'THORChain',
                'Maker' => 'Maker',
                'Harmony' => 'Harmony',
                'PancakeSwap' => 'PancakeSwap',
                'Aave' => 'Aave',
                'BitTorrent (New)' => 'BitTorrent (New)',
                'Gala' => 'Gala',
                'The Graph' => 'The Graph',
                'Zcash' => 'Zcash',
                'Neo' => 'Neo',
                'KuCoin Token' => 'KuCoin Token',
                'Bitcoin SV' => 'Bitcoin SV',
                'Stacks' => 'Stacks',
                'Quant' => 'Quant',
                'Huobi Token' => 'Huobi Token',
                'TrueUSD' => 'TrueUSD',
                'eCash' => 'eCash',
                'Enjin Coin' => 'Enjin Coin',
                'Anchor Protocol' => 'Anchor Protocol',
                'OKB' => 'OKB',
                'Kadena' => 'Kadena',
                'Amp' => 'Amp',
                'Curve DAO Token' => 'Curve DAO Token',
                'Chiliz' => 'Chiliz',
                'Kusama' => 'Kusama',
                'Celo' => 'Celo',
                'Nexo' => 'Nexo',
                'Convex Finance ' => 'Convex Finance ',
                'Basic Attention Token' => 'Basic Attention Token',
                'Dash' => 'Dash',
                'Loopring' => 'Loopring',
                'Arweave' => 'Arweave',
                'Pax Dollar' => 'Pax Dollar',
                'NEM' => 'NEM',
                'Oasis Network' => 'Oasis Network',
                'Theta Fuel' => 'Theta Fuel',
                'Decred' => 'Decred',
                'Mina' => 'Mina',
                'Symbol' => 'Symbol',
                'Secret' => 'Secret',
                'BORA' => 'BORA',
                'Compound' => 'Compound',
                'yearn.finance' => 'yearn.finance',
                'Holo' => 'Holo',
                'Celsius' => 'Celsius',
                'IoTeX' => 'IoTeX',
                'Qtum' => 'Qtum',
                'XDC Network' => 'XDC Network',
                'renBTC' => 'renBTC',
                'Gnosis' => 'Gnosis',
            ],
        ])
        ->add('quantity', NumberType::class,[
            'label' => false,
            'attr'=>[
                'placeholder'=>"Quantité"
            ]
        ])
        ->add('price', NumberType::class,[
            'label' => false,
            'attr'=>[
                'placeholder'=>"Prix d'achat"
            ]
        ])
        
        ->add('submit', SubmitType::class,[
            'label'=>'Submit',
            'attr'=>[
                'class'=>'btn btn-light border px-4 border-secondary text-center  '
            ]
        ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Purchase::class,
        ]);
    }
}
